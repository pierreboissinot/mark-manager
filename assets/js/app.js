// loads the Bootstrap jQuery plugins
import 'bootstrap-sass/assets/javascripts/bootstrap/transition.js';
import 'bootstrap-sass/assets/javascripts/bootstrap/alert.js';
import 'bootstrap-sass/assets/javascripts/bootstrap/collapse.js';
import 'bootstrap-sass/assets/javascripts/bootstrap/dropdown.js';
import 'bootstrap-sass/assets/javascripts/bootstrap/modal.js';

import introJs from 'intro.js';

// and check for it when deciding whether to start.
window.addEventListener('load', function() {
    let tourButton = document.querySelector('#tour');
    tourButton.addEventListener('click', function() {
        introJs().start();
    });
});