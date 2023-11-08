"use strict"

const URL = "api/secciones/";

let secciones = [];

let form = document.querySelector('#seccion-form');
form.addEventListener('submit', insertSeccion);


/**
 * Obtiene todas las secciones de la API REST
 */
async function getAll() {
    try {
        let response = await fetch(URL);
        if (!response.ok) {
            throw new Error('Recurso no existe');
        }
        secciones = await response.json();

        showsecciones();
    } catch(e) {
        console.log(e);
    }
}

/**
 * Inserta una seccion via API REST
 */
async function insertSeccion(e) {
    e.preventDefault();
    
    let data = new FormData(form);
    let seccion = {
        id_noticia: data.get('id_noticia'),
        tipo: data.get('tipo'),
        descripcion: data.get('descripcion'),
        orden: data.get('orden'),
    };

    try {
        let response = await fetch(URL, {
            method: "POST",
            headers: { 'Content-Type': 'application/json'},
            body: JSON.stringify(seccion)
        });
        if (!response.ok) {
            throw new Error('Error del servidor');
        }

        let nSeccion = await response.json();

        // inserto la tarea nuevo
        secciones.push(nSeccion);
        showsecciones();

        form.reset();
    } catch(e) {
        console.log(e);
    }
} 

async function deleteSeccion(e) {
    e.preventDefault();
    try {
        let id = e.target.dataset.seccion;
        let response = await fetch(URL + id, {method: 'DELETE'});
        if (!response.ok) {
            throw new Error('Recurso no existe');
        }

        // eliminar la tarea del arreglo global
        secciones = secciones.filter(seccion => seccion.id != id);
        showSecciones();
    } catch(e) {
        console.log(e);
    }
}

function showSecciones() {
    let ul = document.querySelector("#seccion-list");
    ul.innerHTML = "";

    // asigno event listener para los botones
    const btnsDelete = document.querySelectorAll('a.btn-delete');
    for (const btnDelete of btnsDelete) {
        btnDelete.addEventListener('click', deleteSeccion);
    }
}

getAll();