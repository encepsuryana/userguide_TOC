/**
 * jQuery Script
 * @author Encep Suryana
 */

 //Reading Time estimate generator
 ;(function($) {

 	$.fn.readingTime = function(options) {

		const defaults = {
			readingTimeTarget: '.eta',
			readingTimeAsNumber: false,
			wordCountTarget: null,
			wordsPerMinute: 270,
			round: true,
			lang: 'en',
			lessThanAMinuteString: '',
			prependTimeString: '',
			prependWordString: '',
			remotePath: null,
			remoteTarget: null,
			success: function() {},
			error: function() {}
		};

		const plugin = this;
		const el = $(this);

		let wordsPerSecond;
		let lessThanAMinute;
		let minShortForm;

		let totalWords;
		let totalReadingTimeSeconds;

		let readingTimeMinutes;
		let readingTimeSeconds;
		let readingTime;
		let readingTimeObj;

		plugin.settings = $.extend({}, defaults, options);

		const s = plugin.settings;

		const setTime = function(o) {

			if(o.text !== '') {

				totalWords = o.text.trim().split(/\s+/g).length;

				wordsPerSecond = s.wordsPerMinute / 60;

				totalReadingTimeSeconds = totalWords / wordsPerSecond;

				readingTimeMinutes = Math.floor(totalReadingTimeSeconds / 60);

				readingTimeSeconds = Math.round(totalReadingTimeSeconds - (readingTimeMinutes * 60));

				readingTime = `${readingTimeMinutes}:${readingTimeSeconds}`;

				if(s.round) {

					if(readingTimeMinutes > 0) {

						$(s.readingTimeTarget).text(s.prependTimeString + readingTimeMinutes + ((!s.readingTimeAsNumber) ? ' ' + minShortForm : ''));

					} else {

						$(s.readingTimeTarget).text((!s.readingTimeAsNumber) ? s.prependTimeString + lessThanAMinute : readingTimeMinutes);
					}

				} else {

					$(s.readingTimeTarget).text(s.prependTimeString + readingTime);
				}

				if(s.wordCountTarget !== '' && s.wordCountTarget !== undefined) {

					$(s.wordCountTarget).text(s.prependWordString + totalWords);
				}

				readingTimeObj = {
					wpm: s.wordsPerMinute,
					words: totalWords,
					eta: {
						time: readingTime,
						minutes: readingTimeMinutes,
						seconds: totalReadingTimeSeconds
					}
				};

				s.success.call(this, readingTimeObj);

			} else {

				s.error.call(this, {
					error: 'The element does not contain any text'
				});
			}
		};

		if(!this.length) {

			s.error.call(this, {
				error: 'The element could not be found'
			});

			return this;
		}

		if (s.lang == 'ar') {
			lessThanAMinute = s.lessThanAMinuteString || "أقل من دقيقة";
			minShortForm = 'دقيقة';

		} else if(s.lang == 'cz') {
			lessThanAMinute = s.lessThanAMinuteString || "Méně než minutu";
			minShortForm = 'min';

		} else if(s.lang == 'da') {
			lessThanAMinute = s.lessThanAMinuteString || "Mindre end et minut";
			minShortForm = 'min';

		} else if(s.lang == 'de') {
			lessThanAMinute = s.lessThanAMinuteString || "Weniger als eine Minute";
			minShortForm = 'min';

		} else if(s.lang == 'es') {
			lessThanAMinute = s.lessThanAMinuteString || "Menos de un minuto";
			minShortForm = 'min';

		} else if(s.lang == 'fr') {
			lessThanAMinute = s.lessThanAMinuteString || "Moins d'une minute";
			minShortForm = 'min';

		} else if(s.lang == 'hu') {
			lessThanAMinute = s.lessThanAMinuteString || "Kevesebb mint egy perc";
			minShortForm = 'perc';

		} else if(s.lang == 'is') {
			lessThanAMinute = s.lessThanAMinuteString || "Minna en eina mínútu";
			minShortForm = 'min';

		} else if(s.lang == 'it') {
			lessThanAMinute = s.lessThanAMinuteString || "Meno di un minuto";
			minShortForm = 'min';

		} else if(s.lang == 'nl') {
			lessThanAMinute = s.lessThanAMinuteString || "Minder dan een minuut";
			minShortForm = 'min';

		} else if(s.lang == 'no') {
			lessThanAMinute = s.lessThanAMinuteString || "Mindre enn ett minutt";
			minShortForm = 'min';

		} else if(s.lang == 'pl') {
			lessThanAMinute = s.lessThanAMinuteString || "Mniej niż minutę";
			minShortForm = 'min';

		} else if(s.lang == 'ru') {
			lessThanAMinute = s.lessThanAMinuteString || "Меньше минуты";
			minShortForm = 'мой';

		} else if(s.lang == 'sk') {
			lessThanAMinute = s.lessThanAMinuteString || "Menej než minútu";
			minShortForm = 'min';

		} else if(s.lang == 'sv') {
			lessThanAMinute = s.lessThanAMinuteString || "Mindre än en minut";
			minShortForm = 'min';

		} else if(s.lang == 'tr') {
			lessThanAMinute = s.lessThanAMinuteString || "Bir dakikadan az";
			minShortForm = 'dk';
		
		} else if(s.lang == 'id') {
			lessThanAMinute = s.lessThanAMinuteString || 'Kurang dari semenit';
			minShortForm = 'Menit untuk membaca';

		} else {
			lessThanAMinute = s.lessThanAMinuteString || 'Less than a minute';
			minShortForm = 'Minutes to read';
		}
		

		el.each(function(index) {

			if(s.remotePath != null && s.remoteTarget != null) {

				$.get(s.remotePath, function(data) {

					setTime({
						text: $('<div>').html(data).find(s.remoteTarget).text()
					});
				});

			} else {

				setTime({
					text: el.text()
				});
			}
		});

		return true;
	}
})(jQuery);
