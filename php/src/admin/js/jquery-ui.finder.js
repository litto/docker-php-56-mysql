(function( $, window, document, undefined ){
	
	$.widget('ui.finder', {

		// Default widget options
		// these are overwritten when the widget is
		// initialized with a map parameter
		options: {

			backButtonText : 'Back',
			css : {

				active            : 'active',
				backButton        : 'ui-finder-backbutton',
				container         : 'ui-finder-container',
				dropContainer     : 'ui-finder-drop',
				dropListContainer : 'ui-finder-drop-list',
				dropFooter        : 'ui-finder-drop-footer',
				input             : 'ui-finder-field',
				list              : 'ui-finder-list',
				listContainer     : 'ui-finder-list-container',
				listItem          : 'ui-finder-list-item',
				replaced          : 'ui-finder-select'

			},
			debug          : false,
			divider        : ' > ',
			duration       : 300,
			easing         : 'linear',
			indent         : '&nbsp;&nbsp;&nbsp;&nbsp;',
			maxHeight      : 150,
			valueAttribute : 'data-finder-value',
			width          : 0,
			cache 		   : { 

				breadCrumbTrail   : null,
				container         : null,
				currentList       : null,
				dropContainer     : null,
				dropFooter        : null,
				dropListContainer : null,
				listContainer     : null,
				selectedItem      : null

			}

		},


		/**
		| _create
		| ---------------------------------------------------------------------------------
		| initialize the finder, does UI replacement and creates/indexes the finder's
		| plugin.options.cache.
		|
		*/
		_create: function() {
			
			// Preserve the almighty this
			var plugin = this, crumbs = [];

			// Event hook
			plugin._trigger('beforeLoad');

			// Set width
			plugin.options.width = parseInt(plugin.element.outerWidth());

			// Replace <select>
			plugin.element
				.addClass(plugin.options.css.replaced)
				.addClass('ui-helper-hidden-accessible');

			// Start UI replacement
			// Widget container
			plugin.options.cache.container = $('<div></div>');
			plugin.options.cache.container
				.addClass(plugin.options.css.container)
				.addClass('ui-widget')
				.insertAfter(plugin.element);

			// Breadcrumb trail
			plugin.options.cache.breadCrumbTrail = $('<input type="text" readonly="readonly" />');
			plugin.options.cache.breadCrumbTrail	
				.addClass(plugin.options.css.input)
				.attr('name', '_' + plugin.element.attr('name'))
				.css('width', plugin.options.width)
				.appendTo(plugin.options.cache.container);

			// Debug output
			plugin._debug('Original width: ', plugin.options.width);
			
			// List container
			plugin.options.cache.listContainer = $('<div></div>');
			plugin.options.cache.listContainer
				.addClass(plugin.options.css.listContainer)
				.append(plugin._buildUL())
				.appendTo(plugin.options.cache.container);
			
			// Dropdown container
			plugin.options.cache.dropContainer = $('<div></div>');
			plugin.options.cache.dropContainer
				.addClass(plugin.options.css.dropContainer)
				.addClass('ui-helper-hidden-accessible')
				.addClass('ui-corner-all')
				.addClass('ui-widget-content')
				.addClass('ui-menu')
				.appendTo(plugin.options.cache.container);
			
			// Dropdown list container
			plugin.options.cache.dropListContainer = $('<div></div>');
			plugin.options.cache.dropListContainer
				.addClass(plugin.options.css.dropListContainer)
				.css('height', plugin.options.maxHeight)
				.appendTo(plugin.options.cache.dropContainer);
			
			// Dropdown footer
			plugin.options.cache.dropFooter = $('<div></div>');
			plugin.options.cache.dropFooter
				.addClass(plugin.options.css.dropFooter)
				.append( 
					$('<a href="#" />')
						.text(plugin.options.backButtonText)
						.addClass(plugin.options.css.backButton)
				)
				.appendTo(plugin.options.cache.dropContainer);
			
			// Apply jQuery UI state indicators

			plugin.options.cache.listContainer.find('li')
				.addClass('ui-menu-item');

			plugin.options.cache.listContainer.find('a')
				.addClass('ui-corner-all')
				.attr('tabindex', '-1');

			plugin.options.cache.dropFooter.find('a')
				.addClass('ui-state-default')
				.addClass('ui-corner-all')
				.attr('tabindex', '-1');

			plugin.options.cache.listContainer.find('li').has('ul').each(function(i, elem) {

				$(this).children('a').append(
					$('<span class="ui-icon ui-icon-triangle-1-e"></span>')
				);

			});

			// Initialize the breadcrumb trail based on the value of the original select
			// and the data heirarchy
			// also, initialize the selectedItem cache var
			plugin.options.cache.selectedItem = plugin.options.cache.listContainer.find('a').filter(function(i){

				return ( $(this).attr('href') == plugin.element.val() );

			});

			// If no item is selected, default to setting the first option of the top
			// level <ul> as the active item, do this so we never have
			if ( ! plugin.options.cache.selectedItem ) {

				plugin.options.cache.selectedItem = plugin.options.cache.listContainer.find('a:first');

			}
						
			// Determine currentList,
			// based on if a "selectedItem" was found on init
			plugin.options.cache.currentList =  ( plugin.options.cache.selectedItem.length ) ? plugin.options.cache.selectedItem.parent().parent() : plugin.options.cache.listContainer.find('ul').eq(0);
			
			// If there is a selected item, build it's breadcrumb trail
			if ( plugin.options.cache.selectedItem.length ) {

				plugin.options.cache.selectedItem.addClass('')

				plugin.options.cache.selectedItem.parentsUntil('div', 'a').andSelf().each(function(i, elem) {

					crumbs.push(elem.firstChild.textContent);
					
				});
				
				plugin.options.cache.breadCrumbTrail.val(crumbs.join(plugin.options.divider));

			}

			// Event bindings
			// list option events
			plugin.options.cache.listContainer.find('a')
				.on('click.finder', function(e) {

					// Select option
					plugin.select(this);

					// Highlight the temporary version of
					// selectedItem
					plugin.options.cache.dropListContainer.find('a').removeClass('ui-state-highlight');
					$(this).addClass('ui-state-highlight');

					// Block close()
					return false;

				})
				.on('mouseenter.finder mouseleave.finder', function(e){ 

					// Prevent the class from being applied to parent
					// elements due to 'bubbling'
					// Add/remove jquery ui framework class
					if ( e.type == 'mouseenter' ) {

						$(this).focus();

					} else {

						$(this).blur();
					}
					
				})
				.on('focusin.finder focusout.finder', function(e){ 

					// Add/remove jquery ui framework class
					if ( e.type == 'focusin' ) {

						$(this).addClass('ui-state-hover');

					} else {

						$(this).removeClass('ui-state-hover');
					}

					
				});

			// Back button event
			plugin.options.cache.dropFooter.on('click.finder', 'a', function(e) { 

				e.preventDefault(); 
				plugin.previous(); 
				return false; 

			});
				
			// Breadcrumb field
			plugin.options.cache.breadCrumbTrail
				.on('click.finder', function(e) {

					e.preventDefault();

					$(this).focus();

					plugin.open();

					return false;

				})
				.on('focusin.finder', function(e) {

					e.preventDefault();

					plugin.open();

					return false;

				});

			// Event hook
			plugin._trigger('afterLoad');

		},


		/**
		| open
		| ---------------------------------------------------------------------------------
		| Displays the finder
		|
		*/
		open: function() {

			// Preserve the almighty this
			var plugin = this, list, width, height;

			// Close any open finders
			$('.' + plugin.options.css.replaced).finder('close');
			
			// Determine which list to show
			// in our case, it will always be the cached currentList
			// it is set by init() and is updated in all traversing
			list = plugin.options.cache.currentList.clone(true);
			
			// Remove all sub-lists from it
			list.find('ul').remove();
			
			// Clear any contents that may be in the dropdown already
			plugin.options.cache.dropListContainer.children().remove();
			
			// Add new list to dropdown
			list.appendTo(plugin.options.cache.dropListContainer);
			
			// If our currentList is the top level list it's
			// parent should be the list container div
			// if this is the case, hide the footer.
			if ( plugin.options.cache.currentList.parent().is('div') ) {

				plugin.options.cache.dropFooter.hide();

			} else {

				plugin.options.cache.dropFooter.show();

			}
			
			// Set the widget container width to that of the original field
			// This should compensate for fields that change width
			// i.e. those on responsive forms
			//plugin.options.cache.container.css('width', plugin.options.cache.breadCrumbTrail.outerWidth());
			
			// Debug code
			plugin._debug('Container width:', plugin.element.outerWidth());

			// Compensate for border width styling of the dropdown
			width = plugin.options.cache.breadCrumbTrail.width()
					+ parseFloat(plugin.options.cache.breadCrumbTrail.css('borderLeftWidth')) 
					+ parseFloat(plugin.options.cache.breadCrumbTrail.css('borderRightWidth'));
					- parseFloat(plugin.options.cache.dropContainer.css('borderLeftWidth')) 
					- parseFloat(plugin.options.cache.dropContainer.css('borderRightWidth'));
			
			// Debug code
			plugin._debug('Dropdown width:', width);

			// Set dropdown width
			plugin.options.cache.dropListContainer.css('width', width);
			plugin.options.cache.dropContainer.css('width', width);
			
			// Determine dropdown height
			height = ( plugin.options.cache.dropFooter.is(':visible') ) ? plugin.options.maxHeight + plugin.options.cache.dropFooter.outerHeight() : plugin.options.maxHeight;
			
			// Resize dropdown (animated)
			plugin.options.cache.dropContainer
				.removeClass('ui-helper-hidden-accessible')
				.animate({

					height: height

				}, 100, plugin.options.easing, function() { 

					// After animation, do something...

				});

			// Set default focus
			plugin.options.cache.dropListContainer.find('a:first').focus();
			
			// Bind document click event
			// Close the finder if anything but the finder is clicked
			$(document)

				// Click anywere to close
				.on('click.finder', function(e) {
					plugin.close();
				})

				// Keystroke listener
				.on('keydown.finder', function(e) {

					// We will likely need this since
					// all key binds are used for traversing
					// the drilldown options
					var currentFocus = plugin.options.cache.dropListContainer.find('a:focus');

					// Determine which key was pressed
					switch ( e.which ) {

						// Escape
						case 27:
							plugin.close();
							break;

						// Left arrow
						case 37:
							// Go backward
							plugin.previous();
							break;

						// Enter
						case 13:
							// Continue
						
						// Right arrow
						case 39:
							plugin.options.cache.dropListContainer.find('a:focus').click();
							break;

						// Up arrow
						case 38:
							
							// Disable window scrolling
							e.preventDefault();

							// Determine which, if any, options in the dropdown
							// have focus
							if ( currentFocus.length ) {

								// Ensure that there is another option above this
								// one that we can traverse to
								if ( currentFocus.parent().prev().children('a').length ) {
									
									// Set the focus on the next
									// option up
									currentFocus.parent().prev().children('a').focus();

								} else {

									// There are no options up from the current
									// focussed one, so we'll rotate and select the bottom
									plugin.options.cache.dropListContainer.find('a:last').focus();
								}

							} else {

								// No options are focussed, so we'll focus on the
								// first one
								plugin.options.cache.dropListContainer.find('a:first').focus();

							}
							break;

						// Down arrow
						case 40:

							// Disable window scrolling
							e.preventDefault();

							// Determine which, if any, options in the dropdown
							// have focus
							if ( currentFocus.length ) {

								// Ensure that there is another option above this
								// one that we can traverse to
								if ( currentFocus.parent().next().children('a').length ) {
									
									// Set the focus on the next
									// option up
									currentFocus.parent().next().children('a').focus();

								} else {

									// There are no options down from the current
									// focussed one, so we'll rotate and select the bottom
									plugin.options.cache.dropListContainer.find('a:first').focus();
								}

							} else {

								// No options are focussed, so we'll focus on the
								// first one
								plugin.options.cache.dropListContainer.find('a:first').focus();

							}
							break;


					}


				});
			
			// Event hook
			plugin._trigger('onOpen');

		},


		/**
		| close
		| ---------------------------------------------------------------------------------
		| Closes an open finder
		|
		*/
		close: function() {

			// Preserve the almighty this
			var plugin = this;

			// Hide the dropdown
			plugin.options.cache.dropContainer.addClass('ui-helper-hidden-accessible');

			// Destroy keypress event listeners
			$(document).off('keydown.finder');

			// Event hook
			plugin._trigger('onClose');

		},


		/**
		| select
		| ---------------------------------------------------------------------------------
		| Traverses the drilldown finder downward, or forward.
		|
		*/
		select: function( element ) {

			// Preserve the almighty this
			var plugin = this, prevList, nextList, crumbs;

			// Update selectedItem cache var
			plugin.options.cache.selectedItem = plugin.options.cache.listContainer.find('a').filter(function(i) {

				return $(this).attr('href') == $(element).attr('href');

			});

			// Cache the previous list
			// it's going to be whatever is currently showing
			prevList = plugin.options.cache.dropListContainer.children('ul');
			
			// Determine if selection is final, or is there another drilldown
			if ( ! plugin.options.cache.selectedItem.siblings('ul').length ) {
				
				// There is no sub-list to show, so.. do nothing
				// although we do fire an event so that should someone want to
				// do something at this point, they can hook onto it
				plugin._trigger('onBottomLevelSelection');

			} else {

				// There is a sub-list!
				// continue the dance, by that I mean animate the transition
				// from the current list to the sub-list
				
				// Event hook
				plugin._trigger('onTransitionStart');

				// Update the currentList cache vars
				plugin.options.cache.currentList = plugin.options.cache.selectedItem.siblings('ul');
				
				// We're traversing the drilldown, so there is clearly a parent
				// list, so display the 'back' button
				plugin.options.cache.dropFooter.show();
				
				// Dropdown height
				// includes the footer
				plugin.options.cache.dropContainer.css('height', plugin.options.maxHeight + plugin.options.cache.dropFooter.outerHeight());
				
				// Add next list to the dropdown
				nextList = plugin.options.cache.currentList
					.clone(true)
					.hide()
					.appendTo(plugin.options.cache.dropListContainer);
				
				// Strip its sub-lists, we only want one list in the dropdown at a time
				nextList.find('ul').remove();
				
				// Prepare the next menu for animation, 
				// move it to the top-right
				nextList.css({

					position : 'absolute',
					top      : '0px',
					left     : plugin.options.cache.dropListContainer.outerWidth(),
					width    : '100%',
					display  : 'block'

				});
				
				// Prepare the prev menu for animation, 
				// stays put for now, but gets position defined
				prevList.css({

					position : 'absolute',
					top      : '0px',
					left     : '0px',
					width    : '100%'

				});
				
				// Do the dance!
				// slides both menus simultaneously, giving the effect
				// of a sliding ui; when the animation is complete the
				// previous list is removed from the DOM and the position
				// of the new list is set to 'relative', so it plays well with others.
				plugin.options.cache.dropListContainer.children().animate({ left: '-=' + plugin.options.cache.dropListContainer.outerWidth() }, plugin.options.duration, plugin.options.easing, function(){
					
					// Do something after animation...
					// Remove the previous list
					prevList.remove();
					
					// Undo the absolute positioning
					nextList.css({
						position: 'relative',
						top: 'auto',
						left: 'auto',
						width: 'auto'
					});

					// Set default option focus
					plugin.options.cache.dropListContainer.find('a:first').focus();

					// Event hook
					plugin._trigger('onTransitionComplete');

				});

			}
			
			// Update the underlying select
			plugin.element.val(plugin.options.cache.selectedItem.attr('href'));
			
			// Update breadcrumb trail
			crumbs = ( plugin.options.cache.breadCrumbTrail.val() != '' ) ? plugin.options.cache.breadCrumbTrail.val().split(plugin.options.divider) : [];
					
			// Are we replacing a crumb or adding to it?
			if ( crumbs.length == plugin.options.cache.selectedItem.parentsUntil('div', 'ul').length ) {

				crumbs.pop();

			}
			
			// Add this selection to the breadcrumb trail
			crumbs.push( plugin.options.cache.selectedItem[0].firstChild.textContent );

			// Set the actual trail value
			plugin.options.cache.breadCrumbTrail.val(crumbs.join(plugin.options.divider));

			// Debug output
			plugin._debug('Selection: ', element);

			// Event hook
			plugin._trigger('onSelect', null, { 
				name: element.firstChild.textContent,
				value: $(element).attr('href'),
				element: element 
			});

		},


		/**
		| previous
		| ---------------------------------------------------------------------------------
		| Simply does what it says, it traverses the drilldown finder upward, or
		| backward as it were.
		|
		*/
		previous: function() {

			// Preserve the almighty this
			var plugin = this, prevList, nextList, crumbs, ancestors;
			
			// Double-check that we actually -can- go backward
			if ( plugin.options.cache.currentList.parent().is('div') ) {

				return false;

			}

			// Break the breadcrumb trail into segments
			crumbs = plugin.options.cache.breadCrumbTrail.val().split(plugin.options.divider);

			// Only pop the end off of the breadcrumb trail if a selection has been made
			// Beyond 
			ancestors = plugin.options.cache.currentList.parentsUntil('div', 'ul');

			if ( crumbs.length > ancestors.length ) {

				// This looks convoluded, but it protects against glitches that
				// may add more than possible segments to the trail
				crumbs = crumbs.slice(0, crumbs.length - (crumbs.length - ancestors.length));

			}
			
			// Update cache vars
			plugin.options.cache.selectedItem = plugin.options.cache.currentList.parent();
			plugin.options.cache.currentList = plugin.options.cache.selectedItem.parent();

			// Cache previous dropdown list
			prevList = plugin.options.cache.dropListContainer.children('ul');
			
			// Cache next dropdown list
			// add it to the dropdown DOM
			nextList = plugin.options.cache.selectedItem.parent()
				.clone(true)
				.hide()
				.prependTo(plugin.options.cache.dropListContainer);
				
			// Strip sub-lists from next list
			nextList.find('ul').remove();
			
			// Prepare the next menu for animation, move it to the top-right
			// out of sight
			nextList.css({

				position : 'absolute',
				top      : '0px',
				left     : -plugin.options.cache.dropListContainer.outerWidth(),
				width    : '100%',
				display  : 'block'

			});
			
			// Prepare the prev menu for animation
			// for now the list stays put, but it's position is defined so
			// it can move in tandem with nextList
			prevList.css({

				position : 'absolute',
				top      : '0px',
				left     : '0px',
				width    : '100%'

			});

			// Event hook
			plugin._trigger('onTransitionStart');
			
			// Leeeeeeeeeeeeeeeerrrrooy!
			// animation, slides both menus to the right at the same time
			// when the animation is complete, the previous list is removed
			// from the DOM, never to be heard from again
			plugin.options.cache.dropListContainer.children().animate({ left: '+=' + plugin.options.cache.dropListContainer.outerWidth() }, plugin.options.duration, plugin.options.easing, function(){
				
				// Remove the previous list
				prevList.remove();
				
				// Undo the absolute positioning so the list
				// plays well with others
				nextList.css({

					position : 'relative',
					top      : 'auto',
					left     : 'auto',
					width    : 'auto'

				});

				// Set default option focus
				plugin.options.cache.dropListContainer.find('a:first').focus();

				// Event hook
				plugin._trigger('onTransitionComplete');


			});
			
			// Check if the nextList is the top-level
			// if so, hide the 'back' button
			if ( plugin.options.cache.currentList.parent().is('div') ) {

				plugin.options.cache.selectedItem = null;
				plugin.options.cache.dropFooter.hide();
				plugin.options.cache.dropContainer.css('height', plugin.options.maxHeight);

			}

			// Set the breadcrumb string
			plugin.options.cache.breadCrumbTrail.val( crumbs.join(plugin.options.divider) );

			// Event hook
			plugin._trigger('onGoBack');

		},

		/**
		| destroy
		| ---------------------------------------------------------------------------------
		| Not yet used, maybe someday.
		|
		*/
		destroy: function() {

			// Base destructor function
			$.widget.prototype.destroy.call( this );

		},


		/**
		| _buildUL
		| ---------------------------------------------------------------------------------
		| Build <ul> structure based on hierarchical data structure recieved
		| from _buildDataStructure() method
		|
		| @param data hierarchical data array from _buildDataStructure()
		|
		| @return object jQuery <ul> object ready to be inserted into DOM
		|
		*/
		_buildUL: function( data ) {

			// Preserve the almighty this
			var plugin = this, ul, li, anchor;
			
			// Default params
			data = ( typeof data == 'undefined' ) ? this._buildDataStructure() : data;
			
			// Create ul elem
			ul = $('<ul class="' + plugin.options.css.list + '"></ul>');
			
			// Iterate through each data (row)
			$.each(data, function(i, elem) {
				
				// Create li elem
				li = $('<li></li>');
				anchor = $('<a href=""></a>');

				li
					.addClass(plugin.options.css.listItem)
					.appendTo(ul);

				anchor
					.attr('href', elem.value)
					.html(elem.name)
					.appendTo(li);
				
				// Determine if this li has sub-list
				if ( elem.children.length > 0 ) {
					
					// Self reference method to build sub-list
					li.append(plugin._buildUL(elem.children));

				}
			});
			return ul;

		},


		/**
		| _buildDataStructure
		| ---------------------------------------------------------------------------------
		| Build hierarchical data structure by parsing an indented collection of jQuery
		| <option> objects.
		|
		| @param rows array of jQuery objects $('<option>')
		|
		| @param depth int hierarchical depth to look for
		|
		| @return array array of objects 
		|
		*/
		_buildDataStructure: function( rows, depth ) {
			// Preserve the almight this
			var plugin = this, result = [], pieces, next, i;
			
			// Default params
			rows  = ( typeof rows  == 'undefined' ) ? plugin.element.find('option') : rows;
			depth = ( typeof depth == 'undefined' ) ? 1 : depth;
			
			// Iterate through each <option> row
			for ( i = 0; i < rows.length; i++ ) {
				
				// Locate the option to be examined
				option = rows.eq(i);

				// Break the value of the option into segments
				pieces = option.html().split(plugin.options.indent);
				
				// Determine hierarchical depth of row,
				// if it is a sibling to the depth we are looking for
				// add it to the data array, otherwise disregard and keep looking
				
				// Check if the next option has more or less pieces
				next = option.next();
				
				// Is this option the same 'depth' as what we're looking for?
				if ( pieces.length == depth ) {

					// Add the option to our array at current search depth
					result.push({

						name     : pieces[pieces.length-1],
						value    : option.attr('value'),
						children : plugin._buildDataStructure( option.nextAll(), depth + 1 ) // self-reference to build subordinate data structure (depth+1)

					});

				}
				
				// If there is a next option
				if ( next.length ) {

					// Check if the next option is higher depth
					// than our current search, if so our search is over
					// and we start back at search depth - 1
					if ( next.html().split(plugin.options.indent).length < depth ) {

						return result;

					}

				}

			}

			// All options have been examined and classified
			// so we're done
			return result;

		},


		/**
		| _debug
		| ---------------------------------------------------------------------------------
		| Internal wrapper for the console.log() function, it serves a simple purpose:
		| if the internal setting debug (bool) is true, it logs else it doesn't
		|
		*/
		_debug : function() {

			if ( this.options.debug ) {
				
				if ( window.console ) {

					console.log( Array.prototype.slice.call(arguments) );

				}

			}

		},


		/**
		| _setOption
		| ---------------------------------------------------------------------------------
		| Magic method, this just works, don't question it.
		|
		*/
        _setOption : function ( key, value ) {

            switch (key) {

            	case 'open':
                	this.open();
                	break;

                case 'close':
                	this.close();
                	break;

            	default:
					this.options[ key ] = value;
					break;

            }

           this._super( "_setOption", key, value );

        }
	});
	
})(jQuery, window, document);