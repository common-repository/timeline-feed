(function($) {
	'use strict';
	$(document).ready(function() {

		// Copy target text to clipboard.
		function sttfCopy(button, target) {
			$(document).on('click', button, function () {
				var message = $(this).data('message');
				var value = $(target).val();
				var temp = $('<input>');
				$('body').append(temp);
				temp.val(value).select();
				document.execCommand('copy');
				temp.remove();
				window.alert(message);
			});
		}

		// Copy text.
		sttfCopy('#sttf-copy-shortcode-timeline-feed', '#sttf-shortcode-timeline-feed');
		sttfCopy('#sttf-copy-code-timeline-feed', '#sttf-code-timeline-feed');

		var timelineEventsWrap = $('.sttf-events-wrap');

		function updateEventsInput() {
			var events = [];

			timelineEventsWrap.children().each(function() {
				var eventId = $(this).find('.sttf-event-id').val();
				var eventTitle = $(this).find('.sttf-event-title').val();
				var eventDescription = $(this).find('.sttf-event-desc').val();
				var eventUrl = $(this).find('.sttf-event-url').val();
				var eventIcon = $(this).find('.sttf-event-icon').val();
				var eventDate = $(this).find('.sttf-event-date').val();

				if(!eventId) {
					eventId = '';
				}

				events.push({
					'id': eventId,
					'title': eventTitle,
					'desc': eventDescription,
					'url': eventUrl,
					'icon': eventIcon,
					'date': eventDate
				});
			});

			$('#sttf-events').val(JSON.stringify(events));
		}

		// Icon picker.
		function sttfIconPicker(target) {
			target.iconpicker({
				placement: 'top'
			});
		}

		sttfIconPicker($('.sttf-event-icon'));

		$(document).on('iconpickerSelected', '.sttf-event-icon', function() {
			updateEventsInput();
		});

		// Add new event.
		$(document).on('click', '.sttf-events__item--add', function() {
			var timelineEventFields = $('.sttf-events').data('event-fields');
			timelineEventFields = JSON.parse(timelineEventFields);

			var timelineEvent = $(timelineEventFields).hide().prependTo('.sttf-events-wrap').fadeIn('slow');

			sttfIconPicker(timelineEvent.find('.sttf-event-icon'));

			updateEventsInput();
		});

		$(document).on('change', '.sttf-event input, .sttf-event textarea', function() {
			updateEventsInput();
		});

		// Remove event.
		$(document).on('click', '.sttf-event__remove-btn', function() {
			var button = $(this);

			button.parent().fadeOut(250, function() {
				$(this).remove();
				updateEventsInput();
			});
		});

		// Remove all events.
		$(document).on('click', '.sttf-events__item--remove-all', function() {
			var confirmMessage = $(this).data('confirm-message');
			var timelineEvents = $('.sttf-event');

			if(confirm(confirmMessage)) {
				timelineEvents.fadeOut(350, function() {
					timelineEvents.remove();
					updateEventsInput();
				});
			}
		});

		// Numeric slider value.
		$(document).on('input', '.sttf-input-range', function() {
			var value = this.value;
			$(this).parent().find('.sttf-range-value').html(value);
		});

		// Sortable events.
		$('.sttf-events').sortable({
			items: '.sttf-event',
			placeholder: '',
			change: function(event, ui) {
				ui.placeholder.css({visibility: 'visible', border: '2px solid #00a0d2', 'background-color': '#ffffff'});
			},
			stop: function( event,ui ) {
				updateEventsInput();
			}
		});

		// Initialize color picker.
		$('.color-picker').wpColorPicker();

	});
})(jQuery);
