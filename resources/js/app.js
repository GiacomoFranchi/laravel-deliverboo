import "./bootstrap";

import "~resources/scss/app.scss";
import * as bootstrap from "bootstrap";
import { DateTime } from "luxon";
import.meta.glob(["../img/**"]);

//  start MODAL - DELETE ITEM FOOD
const archieveButtons = document.querySelectorAll(".btn-delete-food");
// console.log(archieveButtons);

archieveButtons.forEach((button) => {
    button.addEventListener("click", (event) => {
        event.preventDefault();
        // console.log('clicked');

        const deleteModal = new bootstrap.Modal("#delete-modal");

        const title = button.getAttribute("data-title");
        document.getElementById("name-to-delete").innerHTML = title;

        document
            .getElementById("button-delete")
            .addEventListener("click", () => {
                // console.log(button.parentElement);
                button.parentElement.submit();
            });

        deleteModal.show();
    });
});
// end MODAL - DELETE ITEM FOOD


//  start MODAL - DELETE RESTAURANT

const buttons = document.querySelectorAll(".btn-delete");

buttons.forEach((button) => {
    button.addEventListener("click", (event) => {
        event.preventDefault();

        const deleteModal = new bootstrap.Modal("#delete-modal");

        const title = button.getAttribute("data-title");
        document.getElementById("title-to-delete").innerHTML = title;

        document
            .getElementById("action-delete")
            .addEventListener("click", () => {
                button.parentElement.submit();
            });

        deleteModal.show();
    });
});


// end MODAL - DELETE RESTAURANT
