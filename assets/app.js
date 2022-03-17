/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.css';

// start the Stimulus application
import './bootstrap';

import "bootstrap/dist/css/bootstrap.css";
import "bootstrap/dist/js/bootstrap.bundle.js";

import $ from 'jquery';

import CircleType from 'circletype';

circle();

function circle() {
    const frites = new CircleType(document.getElementById('frites'));
    frites.radius(220);

    const voyage = new CircleType(document.getElementById('voyage'));
    voyage.radius(180);
    voyage.dir(-1);
}