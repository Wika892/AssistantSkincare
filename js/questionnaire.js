const questions = document.querySelectorAll('.question');
const bouton = document.querySelector('#bouton-questionnaire');

let questionActuelle = 0;

function afficherQuestion(numero) {

    questions.forEach((question, index) => {

        if (index === numero) {

            question.style.display = 'block';

            question.animate(
                [
                    {
                        opacity: 0,
                        transform: 'translateX(100px)'
                    },
                    {
                        opacity: 1,
                        transform: 'translateX(0)'
                    }
                ],
                {
                    duration: 600,
                    easing: 'ease-out'
                }
            );

        } else {
            question.style.display = 'none';
        }
    });

    if (numero === questions.length - 1) {
        bouton.style.display = 'inline-block';
    } else {
        bouton.style.display = 'none';
    }
}
questions.forEach((question, index) => {

    const reponses = question.querySelectorAll('input[type="radio"]');

    reponses.forEach((reponse) => {

        reponse.addEventListener('change', () => {

            if (index < questions.length - 1) {
                setTimeout(() => {
                    questionActuelle++;
                    afficherQuestion(questionActuelle);
                }, 300);
            }

        });

    });

});

afficherQuestion(questionActuelle);