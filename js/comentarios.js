"use strict"

const URL = "api/comentarios/";

let comentarios = [];



/**
 * Obtiene todas los comentarios de la API REST
 */
async function getAll() {
    try {
        let response = await fetch(URL);
        if (!response.ok) {
            throw new Error('Recurso no existe');
        }
        secciones = await response.json();

        showComentarios();
    } catch(e) {
        console.log(e);
    }
}

/**
 * Inserta un comentario via API REST
 */
async function insertComentario(e) {
    e.preventDefault();
    
    let data = new FormData(form);
    let comentario = {
        comentario: data.get('comentario'),
        nota: data.get('nota'),
        id_seccion: data.get('id_seccion'),
    };

    try {
        let response = await fetch(URL, {
            method: "POST",
            headers: { 'Content-Type': 'application/json'},
            body: JSON.stringify(comentario)
        });
        if (!response.ok) {
            throw new Error('Error del servidor');
        }

        let nComentario = await response.json();

        // inserto el comentario nuevo
        comentarios.push(nComentario);
        showComentarios();

        form.reset();
    } catch(e) {
        console.log(e);
    }
} 

async function deleteComentario(e) {
    e.preventDefault();
    try {
        let id = e.target.dataset.comentario;
        let response = await fetch(URL + id, {method: 'DELETE'});
        if (!response.ok) {
            throw new Error('Recurso no existe');
        }

        // eliminar el comentario del arreglo global
        comentarios = comentarios.filter(comentario => comentario.id != id);
        showComentarios();
    } catch(e) {
        console.log(e);
    }
}

function showComentarios() {
    let ul = document.querySelector("#Comentario-list");
    ul.innerHTML = "";

    // asigno event listener para los botones
    const btnsDelete = document.querySelectorAll('a.btn-delete');
    for (const btnDelete of btnsDelete) {
        btnDelete.addEventListener('click', deleteComentario);
    }
}

getAll();