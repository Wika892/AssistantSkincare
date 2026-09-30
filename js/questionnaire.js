
// recupere les questions et le bouton

const questions = document.querySelectorAll('.question');
const bouton = document.querySelector('#bouton-questionnaire');

let questionActuelle = 0;

// afficher une question precice

function afficherQuestion(numero) {

    // parcourt toutes les questions
    questions.forEach((question, index) => {
        // verifie question afficher a question quon veut 
        if (index === numero) {

            question.style.display = 'block';
            //ajout animation
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
            //cache toute les autres questions
        } else {
            question.style.display = 'none';
        }
    });
    // verifie si derniere question
    if (numero === questions.length - 1) {
        bouton.style.display = 'inline-block';
        //le bouton reste cacher
    } else {
        bouton.style.display = 'none';
    }
}
// parcour toute les questions
questions.forEach((question, index) => {
    // cherche le bouton radio
    const reponses = question.querySelectorAll('input[type="radio"]');
    // parcour les reponses
    reponses.forEach((reponse) => {
        //detecte les reponces selectionner
        reponse.addEventListener('change', () => {
            // verifie si encore qustion a afficher
            if (index < questions.length - 1) {
                // temps pour passer a la suivante question
                setTimeout(() => {
                    questionActuelle++;
                    afficherQuestion(questionActuelle);
                }, 300);
            }

        });

    });

});
// afficher 1er question au chargement de la page
afficherQuestion(questionActuelle);