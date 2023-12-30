document.addEventListener('livewire:load', function () {
    Livewire.on('updateStep', function (newStep) {
        window.livewire.emit('updateStep', newStep);
    });
});