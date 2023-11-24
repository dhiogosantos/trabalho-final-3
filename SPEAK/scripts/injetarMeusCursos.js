function injetaCurso() {
    $.ajax({
        type: 'POST',
        url: '../scripts/php/carregarMeusCursos.php',
        success: function(response) {
            let cursos = response;
            console.log("response: " + response)
            const container = document.querySelector("div[id='contPrincipal']");
            container.childNodes.forEach(function(item){
                item.remove();
            });
        
            cursos.forEach(curso => {
                const div = document.createElement('div');
                div.classList.add("col-md-6");
                div.classList.add("m-0");
        
                const divDois = document.createElement('div');
                divDois.classList.add("card");
                divDois.classList.add("cardcurso");
                divDois.classList.add("row");
        
                const divTres = document.createElement('div');
                divTres.classList.add("card-body");
        
                const h5 = document.createElement('h5');
                h5.classList.add("card-title");
                h5.textContent = curso.titulo;
        
                const prof = document.createElement('h6');
                prof.textContent = curso.usuarioResponsavel;
        
                const p = document.createElement('p');
                p.classList.add("card-text");
                p.textContent = curso.descricao;
        
                const btn = document.createElement('a');
                btn.classList.add("btn");
                btn.classList.add("btn-primary");
                btn.textContent = "Chat";
                div.addEventListener("click", () => {
                    localStorage.setItem("idChat", curso.idChat)
                    window.location.href = "chat.php";
                })
        
                container.appendChild(div);
                div.appendChild(divDois);
                divDois.appendChild(divTres);
                divTres.appendChild(h5);
                divTres.appendChild(prof);
                divTres.appendChild(p);
                divTres.appendChild(btn);
        
            });
        },
        error: function(error) {
            console.error('Erro na solicitação AJAX:', error);
        }
    })

}

document.addEventListener("DOMContentLoaded", injetaCurso());

