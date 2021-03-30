// TODO!
// There is a JS insertbefore
// Use this if it is a single kanji, to put it straight at the top!
// Could event somehow sort them by length?
// Maybe also only show words that start with that kanji, or it's the first kanji if kana before hand. No idea how to check if it's a kana though!


function doTheKanji(kanjiWant) {
	console.log("Doing the kanji");
	container = document.getElementById("stickyVocab");
	container.innerHTML = "";
	
	kanjiIWant = document.createElement("div");
	kanjiIWant.setAttribute("class", "kanjiTitle");
	kanjiIWant.appendChild(document.createTextNode(kanjiWant))

	container.appendChild(kanjiIWant);

	for (let i = 0; i < bigdata.length; i++) {
		string = bigdata[i].kanji[0];
		if (string.includes(kanjiWant)) {

			vocabContain = document.createElement("div");
			vocabContain.setAttribute("class", "vocab");
			
			kanjiContain = document.createElement("div");
			kanjiContain.setAttribute("class", "vocabKanji");
			kanjiContain.appendChild(document.createTextNode(bigdata[i].kanji[0]))

			kanaContain = document.createElement("div");
			kanaContain.setAttribute("class", "vocabKana");
			kanaContain.appendChild(document.createTextNode(bigdata[i].kana[0]))
			
			englishContain = document.createElement("div");
			englishContain.setAttribute("class", "vocabEnglish");
			englishContain.appendChild(document.createTextNode(bigdata[i].english[0]))

			vocabContain.appendChild(kanjiContain);
			vocabContain.appendChild(kanaContain);
			vocabContain.appendChild(englishContain);
    		container.appendChild(vocabContain);
		}
	}
}

window.addEventListener('load', function () {
	doTheKanji("説");
  })

  document.addEventListener('click', function(event) {
	if (event.target.className == "kanji") {
	  doTheKanji(event.target.innerHTML);
	}
  });