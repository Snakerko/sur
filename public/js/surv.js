$(function(){

  $('#go').click(function(){     

   appearance('#start','#second'); 

   return false;
   
   });

  $('#good').click(function(){     

   appearance('#second','#third'); 

   return false;
   
   });

  $('#ok').click(function(){

    $.getJSON('poll.json',function(data){
      data=(typeof data==='string')?JSON.parse(data):data;

      const content = document.getElementById('content');
      const patternNode = content.querySelector('.pattern');

      patternNode.classList.remove('pattern');
      const pattern = patternNode.outerHTML;
      patternNode.parentNode.removeChild(patternNode);

      data.forEach(function(question, index) {
          content.insertAdjacentHTML('beforeEnd', pattern.replace(/{%\s?question\s?%}/gim, question.question));
          const questionNode = content.lastChild;
          questionNode.dataset.index = index;
          questionNode.style.display = 'none';
          const answers = questionNode.querySelector('.answers');
          const number = questionNode.querySelector('.number');
          number.innerHTML = question.id;
          const answer = answers.querySelector('.radio').outerHTML;
          answers.innerHTML = question.answers.map(function(title, value) {
            return answer
              .replace(/{%\s?id\s?%}/gim, question.id)
              .replace(/{%\s?answer.title\s?%}/gim, title)
              .replace(/{%\s?answer.value\s?%}/gim, value);
        }).join("\n");
      });

      let currentQuestionIndex = 0;
      const questions = [].slice.call(content.querySelectorAll('[data-index]'));
      questions[0].style.display = 'block';

      const btn = document.getElementById("vote").querySelector('.btn');
      function enableBtn(e) {
        if(e.target.tagName === 'INPUT') {
          btn.disabled = false;
          document.getElementById("vote").removeEventListener('click', enableBtn);
        }
      }
      vote.addEventListener('click', enableBtn);

      document.querySelector('#vote [type="submit"]').addEventListener('click', function(e) {

        document.getElementById("vote").addEventListener('click', enableBtn);

        questions[currentQuestionIndex].style.display = 'none';
        if (++currentQuestionIndex >= questions.length)
            return;

        e.preventDefault();
        questions[currentQuestionIndex].style.display = 'block';
        document.querySelector('.answer-btn').setAttribute("disabled", "disabled");
      });

    });
    appearance('#third','#content-wrapper'); 

    return false;
   
  });

  var appearance = function(slide,content) {

    $(slide).hide('fast',showNewContent);
    $('#load').remove();
    $('#wrapper').append('<span id="load">LOADING...</span>');
    $('#load').fadeIn('normal');

    function showNewContent() {
      $(content).show('normal',hideLoader());
    }
    
    function hideLoader() {
      $('#load').fadeOut('normal');
    }
  };

});