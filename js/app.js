"use strict"

const URL = "api/noticias/";

let noticias = [];

let form = document.querySelector('#noticia-form');
form.addEventListener('submit', insertNoticia);


/**
 * Obtiene todas las noticias de la API REST
 */
async function getAll() {
    try {
        let response = await fetch(URL);
        if (!response.ok) {
            throw new Error('Recurso no existe');
        }
        noticias = await response.json();

        shownoticias();
    } catch(e) {
        console.log(e);
    }
}

/**
 * Inserta una noticia via API REST
 */
async function insertNoticia(e) {
    e.preventDefault();
    
    let data = new FormData(form);
    let noticia = {
        id_noticia: data.get('id_noticia'),
        titulo: data.get('titulo'),
        fecha: data.get('fecha'),
        autor: data.get('autor'),
        texto: data.get('texto'),
        imagen: data.get('imagen'),
    };

    try {
        let response = await fetch(URL, {
            method: "POST",
            headers: { 'Content-Type': 'application/json'},
            body: JSON.stringify(noticia)
        });
        if (!response.ok) {
            throw new Error('Error del servidor');
        }

        let nNoticia = await response.json();

        // inserto la tarea nuevo
        noticias.push(nNoticia);
        shownoticias();

        form.reset();
    } catch(e) {
        console.log(e);
    }
} 

async function deleteNoticia(e) {
    e.preventDefault();
    try {
        let id = e.target.dataset.noticia;
        let response = await fetch(URL + id, {method: 'DELETE'});
        if (!response.ok) {
            throw new Error('Recurso no existe');
        }

        // eliminar la tarea del arreglo global
        noticias = noticias.filter(noticia => noticia.id != id);
        shownoticias();
    } catch(e) {
        console.log(e);
    }
}

function showNoticias() {
    let ul = document.querySelector("#noticia-list");
    ul.innerHTML = "";

    // asigno event listener para los botones
    const btnsDelete = document.querySelectorAll('a.btn-delete');
    for (const btnDelete of btnsDelete) {
        btnDelete.addEventListener('click', deleteNoticia);
    }
}

getAll();