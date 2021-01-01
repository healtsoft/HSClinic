document.addEventListener('DOMContentLoaded', function() {
    let popperInstance = null;
    
    tippy('#myButton', {
            content: 'Dolor de wevos',
            allowHTML: true,
    });

    
    const template = document.getElementById('template');

    tippy('#panel', {
    content: template.innerHTML,
    allowHTML: true,
    interactive: true,
    trigger: 'click',
    maxWidth: 380,
    });

    
});