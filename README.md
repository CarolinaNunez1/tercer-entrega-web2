ENDPOINTS

GET -> /api/noticias (me devuelve todos las noticias)
       /api/comentarios (me devuelve todos los comentarios)
por ejemplo http://localhost/tercer-entrega-web2/api/noticias con GET me devuelve todas las noticias
            http://localhost/tercer-entrega-web2/api/comentarios con GET me devuelve todos los comentarios 

GET:ID-> /api/noticias/:ID (me devuelve una noticia con cierto id)
por ejemplo http://localhost/tercer-entrega-web2/api/noticias/1 con GET/:1 me devuelve la noticia con id=1
GET:ID-> /api/comentarios/:ID (me devuelve un comentario con cierto id)
por ejemplo http://localhost/tercer-entrega-web2/api/comentarios/2 con GET/:2 me devuelve el comentario con id=2

Para POST, PUT, DELETE vamos a necesitar una autorizacion 
POST, PUT, DELETE -> /api/auth/token (voy a authorization type = basic auth pongo usuario: Flor  contraseña: silva, presiono send me trae el token, luego voy a type = bearer token, pego el token y vuelvo a la url normal)
por ejemplo http://localhost/tercer-emtrega-web2/api/auth/token con Get y siguiendo los pasos.

POST-> /api/noticias (me agrega una nueva noticia)
por ejemplo http://localhost/tercer-entrega-web2/api/noticias con POST me agrega una nueva noticia
POST-> /api/comentarios (me agrega un nuevo comentario)
por ejemplo http://localhost/tercer-entrega-web2/api/comentarios con POST me agrega un nuevo comentario

PUT-> /api/noticias (me modifica una noticia)
por ejemplo http://localhost/tercer-entrega-web2/api/noticias con PUT me modifica una noticia
PUT-> /api/comentarios (me modifica un comentario)
por ejemplo http://localhost/tercer-entrega-web2/api/comentarios con PUT me modifica un comentario


DELETE:ID-> /api/noticias/:id
por ejemplo http://localhost/tercer-entrega-web2/api/noticias/1 con DELETE me elimina la noticia con id=1
DELETE:ID-> /api/comentarios/:id
por ejemplo http://localhost/tercer-entrega-web2/api/comentarios/2 con DELETE me elimina el comentario con id=2