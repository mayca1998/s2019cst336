      // Your JavaScript goes here
    var randomNumber = Math.floor(Math.random() * 99) + 1;
    var guesses = document.querySelector('#guesses');
    var lastResult = document.querySelector('#lastResult');
    var lowOrHi = document.querySelector('#lowOrHi');
    var w = document.querySelector('#w');
    var l = document.querySelector('#l');
    var win = 0;
    var lost = 0;

      

      var guessSubmit = document.querySelector('.guessSubmit');
      var guessField = document.querySelector('.guessField');
    
      var guessCount = 1;
      var resetButton = document.querySelector('#reset');
      resetButton.style.display = 'none';
      guessField.focus();
      
      function checkGuess() {
            var userGuess = Number(guessField.value);
            if (guessCount === 1) {
                guesses.innerHTML = 'Previous guesses: ';
            }
            if(userGuess < 100)
            {
                guesses.innerHTML += userGuess + ' ';
            }
            if (userGuess === randomNumber) {
                lastResult.innerHTML = 'Congratulations! You got it right!';
                lastResult.style.backgroundColor = 'green';
                lowOrHi.innerHTML = '';
                win++;

                setGameOver();
              }
              else if (guessCount === 7) {
                lastResult.innerHTML = 'Sorry, you lost!';
                lost++;
                setGameOver();
              }
              else {
                lastResult.innerHTML = 'Wrong!';
                lastResult.style.backgroundColor = 'red';
                if(userGuess < randomNumber) {
                  lowOrHi.innerHTML = 'Last guess was too low!';
                }
                else if(userGuess > randomNumber && userGuess < 100){
                        lowOrHi.innerHTML = 'Last guess was too high!';
                } 
                else if(userGuess > 99){
                    lowOrHi.innerHTML = 'Last guess is not valid: too high!';
                    lowOrHi.style.backgroundColor = 'red';
                    userGuess.valueOf('');
                    guessCount--;
                    }
              }
             
             
              guessCount++;
              guessField.value = '';
              guessField.focus();
      }
      
      guessSubmit.addEventListener('click', checkGuess);
      
      function setGameOver() {
        w.innerHTML = 'Games Won: ' + win;
        //w.style.backgroundColor = 'white';
        l.innerHTML = 'Games Lost: '+ lost;
        //l.style.backgroundColor = 'white';


        guessField.disabled = true;
        guessSubmit.disabled = true;
        resetButton.style.display = 'inline';
        resetButton.addEventListener('click', resetGame);
      }
      
      function resetGame() {
        guessCount = 1;
      
        var resetParas = document.querySelectorAll('.resultParas p');
        for (var i = 0 ; i < resetParas.length ; i++) {
          resetParas[i].textContent = '';
        }
      
        //resetButton.style.display = 'none';
      
        guessField.disabled = false;
        guessSubmit.disabled = false;
        guessField.value = '';
        guessField.focus();
      
        lastResult.style.backgroundColor = 'white';
      
        randomNumber = Math.floor(Math.random() * 99) + 1;
      }