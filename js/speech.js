function startDictation() {
  if (window.hasOwnProperty('SpeechRecognition') || window.hasOwnProperty('webkitSpeechRecognition')) {
    var recognition = new (window.SpeechRecognition || window.webkitSpeechRecognition)();

    recognition.continuous = false;
    recognition.interimResults = false;

    recognition.lang = 'en-US';
    recognition.start();

    recognition.onstart = function() {
      document.getElementById('word').placeholder = 'Speak Now';
      recognizing = true;
    };

    recognition.onend = function() {
      document.getElementById('word').placeholder = 'No Speech Detected!';
    };

    recognition.onresult = function(e) {
      var transcript = e.results[0][0].transcript;
      // Replace word forms of numbers with numeric symbols
      transcript = transcript.replace(/\bone\b/g, '1');
      transcript = transcript.replace(/\btwo\b/g, '2');
      transcript = transcript.replace(/\bthree\b/g, '3');
      // Replace "to" with "2"
      transcript = transcript.replace(/\bto\b/g, '2');
      // Replace "first" with "1st"
      transcript = transcript.replace(/\bfirst\b/g, '1st');
      // Replace "second" with "2nd"
      transcript = transcript.replace(/\bsecond\b/g, '2nd');
      // Replace "third" with "3rd"
      transcript = transcript.replace(/\bthird\b/g, '3rd');

      document.getElementById('word').value = transcript;
      recognition.stop();
      document.getElementById('babel').submit();
    };

    recognition.onerror = function(e) {
      recognition.stop();
    };
  }
}
