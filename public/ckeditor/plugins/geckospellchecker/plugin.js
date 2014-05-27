/*
 * @file GeckoSpellcheker plugin for CKEditor
 * Copyright (C) 2008-2009 Alfonso Martínez de Lizarrondo
 *
 * == BEGIN LICENSE ==
 *
 * Licensed under the terms of any of the following licenses at your
 * choice:
 *
 *  - GNU General Public License Version 2 or later (the "GPL")
 *    http://www.gnu.org/licenses/gpl.html
 *
 *  - GNU Lesser General Public License Version 2.1 or later (the "LGPL")
 *    http://www.gnu.org/licenses/lgpl.html
 *
 *  - Mozilla Public License Version 1.1 or later (the "MPL")
 *    http://www.mozilla.org/MPL/MPL-1.1.html
 *
 * == END LICENSE ==
 *
 * See docs/install.html
 */

var GeckoSpellchecker = {

	// This function tries to call the internal Firefox spellchecker in order to get suggestions for the current click
	// it needs that the Write Area extension is already installed because by default there's no such call system in place.
	fillSuggestions : function( ev )
	{
		// Init to no errors or no spellchecker available.
		this.mSpellSuggestions = null ;

		if (document.location.protocol == 'chrome:')
			this._callInternalSpellcheker( ev ) ;
		else
			this._callExtensionSpellcheker( ev ) ;

	},

	// Called from web page, create a fake event to get the suggestions with our extension
	_callExtensionSpellcheker : function(ev)
	{
		// Create our custom event 'nsDOMQuerySpellchecker'
		var node = ev.target ;
		var doc = node.ownerDocument ;
		var newEv = doc.createEvent( 'MouseEvent' ) ;
		newEv.initMouseEvent( 'nsDOMQuerySpellchecker', true, true, doc.defaultView, ev.detail,
						ev.screenX, ev.screenY, ev.clientX, ev.clientY, ev.ctrlKey, ev.altKey,
						ev.shiftKey, ev.metaKey, ev.button, ev.relatedTarget ) ;

		// The rangeOffset doesn't get cloned, so we need to copy it in a custom attribute.
		node.setAttribute( 'myRangeOffset', ev.rangeOffset ) ;

		// Store the data to replace the misspelled word
		this.mWordNode = ev.rangeParent ;
		this.mWordOffset = ev.rangeOffset ;

		// Now this is where the magic happens. The event goes up and when it's been processed we will have the answer
		node.dispatchEvent( newEv ) ;

		// First remove the previous attribute:
		node.removeAttribute( 'myRangeOffset' ) ;

		// Check if there was a misspelling
		this.misspelling = node.getAttribute( 'spellcheck_misspelling');
		// The call has failed, the extension isn't installed
		if ( this.misspelling === null )
			return ;
		node.removeAttribute( 'spellcheck_misspelling' ) ;
		// Ok, the word is right.
		if (this.misspelling === '')
			return ;

		// Get the suggestions and store them in an array.
		this.mSpellSuggestions = [] ;

		var nSuggestions = parseInt( node.getAttribute( 'spellcheck_suggestions' ), 10) ;
		node.removeAttribute( 'spellcheck_suggestions' ) ;

		for( var i=0; i<nSuggestions; i++ )
		{
			var suggestion = node.getAttribute( 'spellcheck_suggestion' + i) ;
			if (suggestion)
			{
				node.removeAttribute( 'spellcheck_suggestion' + i) ;
				this.mSpellSuggestions.push( suggestion ) ;
			}
		}
	},

	// Call inside chrome, the event doesn't arrive to the listener, so let's do it directly.
  _callInternalSpellcheker: function(evt)
	{
		// Store the data to replace the misspelled word
		this.mWordNode = evt.rangeParent ;
		this.mWordOffset = evt.rangeOffset ;

		// if the document is editable do our task
		var win = evt.target.ownerDocument.defaultView;
		if (win) {
			var editingSession = win.QueryInterface(Components.interfaces.nsIInterfaceRequestor)
															.getInterface(Components.interfaces.nsIWebNavigation)
															.QueryInterface(Components.interfaces.nsIInterfaceRequestor)
															.getInterface(Components.interfaces.nsIEditingSession);
			if (editingSession.windowIsEditable(win)) {

				InlineSpellCheckerUI.init(editingSession.getEditorForWindow(win));
				InlineSpellCheckerUI.initFromEvent(this.mWordNode, this.mWordOffset);

				this.misspelling = InlineSpellCheckerUI.mMisspelling ;
				if ( !InlineSpellCheckerUI.overMisspelling )
					return ;

				var nSuggestions = 10 ;

				// Get the suggestions and store them in an array.
				this.mSpellSuggestions = this.getSpellcheckSuggestions( nSuggestions ) ;
			}
		}

  },

  // Returns an array of up to maxNumber suggestions for the currently misspelled word
	// it can be called only inside Chrome
  getSpellcheckSuggestions: function( maxNumber )
  {
    if (! InlineSpellCheckerUI.mInlineSpellChecker || ! InlineSpellCheckerUI.mOverMisspelling)
      return 0; // nothing to do

    var spellchecker = InlineSpellCheckerUI.mInlineSpellChecker.spellChecker;
    if (! spellchecker.CheckCurrentWord(InlineSpellCheckerUI.mMisspelling))
      return 0;  // word seems not misspelled after all (?)

    var mSpellSuggestions = [];

    for (var i = 0; i < maxNumber; i ++) {
      var suggestion = spellchecker.GetSuggestedWord();
      if (! suggestion.length)
        break;
       mSpellSuggestions.push(suggestion);

    }
    return mSpellSuggestions;
  },


	// Almost like the internal function
  replaceMisspelling: function(doc, index)
  {
    if (! this.mSpellSuggestions)
      return;
    if (index < 0 || index >= this.mSpellSuggestions.length)
      return;
    this.replaceWord(doc, this.mWordNode, this.mWordOffset,
                                         this.mSpellSuggestions[index]);
  },

	// a first approach for this function.
  replaceWord: function(doc, node, offset, replacement)
  {
		var text = node.nodeValue ;

		// Find the word boundaries. Is there a better way?
		// we could use directly text.replace with the misspelled word, but it will fail if there are several instances.
		var regSeparator = /\b/ ;
		var start = offset;
		while (start>=0 && regSeparator.test(text.charAt(start) ) )
			start-- ;

		start++;

		var end = offset;
		while (end<text.length && regSeparator.test(text.charAt(end) ) )
			end++ ;

		// Do the replacement
		node.nodeValue = text.substr(0, start) + replacement + text.substr(end);

		// Now set the new word as selected
		var selection =	doc.defaultView.getSelection() ;
		selection.removeAllRanges() ;

		var range = doc.createRange();  //FCK.EditorDocument.createRange() ;
		range.setStart(node, start);
		range.setEnd(node, start + replacement.length) ;
		selection.addRange(range);
	}
}



CKEDITOR.plugins.add( 'geckospellchecker',
{
	beforeInit : function( editor )
	{
		// Only for Firefox.
		if (!CKEDITOR.env.gecko)
			return;

		// Register own rbc menu group.
		editor.config.menu_groups = 'SpellGroup,' + editor.config.menu_groups;

		// Listen to the native contextMenu event
		editor.on('contentDom', function(ev)
			{
				ev.editor.document.on( 'contextmenu', function( event )
					{
						// Get the spell suggestions.
						GeckoSpellchecker.fillSuggestions( event.data.$ ) ;
					});
			}
		) ;
	},

	init : function( editor )
	{
		// Only for Firefox.
		if (!CKEDITOR.env.gecko)
			return;
			
		editor.config.disableNativeSpellChecker = false ;

		// If the "contextmenu" plugin is loaded, register the listeners.
		if ( editor.contextMenu )
		{
			editor.contextMenu.addListener( function( element, selection )
				{
					// Context menu constructing.
					var addButtonCommand = function( editor, buttonName, buttonLabel, commandName, command, menugroup, menuOrder )
					{
						editor.addCommand( commandName, command );

						// If the "menu" plugin is loaded, register the menu item.
						editor.addMenuItem( commandName,
							{
								label : buttonLabel,
								command : commandName,
								group : menugroup,
								order : menuOrder
							});
					};

					var suggestions = GeckoSpellchecker.mSpellSuggestions ;

					if ( !suggestions )
						return null;

					var menuSuggestions = {};

					for (var i=0; i<suggestions.length; i++ )
					{
						var commandName = 'Gecko_suggestion_' + i;
						var exec = ( function( index )
							{
								return {
									exec: function(editor)
									{
										editor.fire( 'saveSnapshot' );	// Save undo step.
										GeckoSpellchecker.replaceMisspelling(editor.document.$, index ) ;
									}
								};
							})( i );

						addButtonCommand( editor, 'button_' + commandName, suggestions[i],
							commandName, exec, 'SpellGroup', i + 1 );

						menuSuggestions[ commandName ] = CKEDITOR.TRISTATE_OFF;
					}

					return menuSuggestions;
				});
		}
	}
} );

