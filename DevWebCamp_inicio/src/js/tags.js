(function(){
    const tagsI = document.querySelector('#tags_input');
    if(tagsI){
        const tagsDiv = document.querySelector('#tags');
        const tagsHidden = document.querySelector("[name='tags']");
        let tags = [];
        if(tagsHidden.value !== ''){
            tags = tagsHidden.value.split(',');
            mostrarTags();
        }
        tagsI.addEventListener('keypress', guardarTag);
        function guardarTag(e){
            if(e.keyCode === 44){
                if(e.target.value.trim() === '' || e.target.value.length < 3) return;
                e.preventDefault();
                tags = [...tags, e.target.value.trim()];
                tagsI.value = '';
                mostrarTags();
            }
        };
        function mostrarTags(){
            tagsDiv.textContent = '';
            tags.forEach(tag => {
                const etiqueta = document.createElement('LI');
                etiqueta.classList.add('formulario__tag');
                etiqueta.textContent = tag;
                etiqueta.ondblclick = eliminarTag;
                tagsDiv.appendChild(etiqueta);
            });
            actualizarInputHidden();
        }
        function eliminarTag(e){
            e.target.remove();
            tags = tags.filter(tag => tag !== e.target.textContent);
            actualizarInputHidden();
        }
        function actualizarInputHidden(){
            tagsHidden.value = tags.toString();
        }
    }
})()