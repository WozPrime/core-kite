document.querySelectorAll('input[type-currency="IDR"]').forEach((element) => {
    element.addEventListener('keyup', function(e) {
    let cursorPostion = this.selectionStart;
      let value = parseInt(this.value.replace(/[^,\d]/g, ''));
      let originalLenght = this.value.length;
      if (isNaN(value)) {
        this.value = "";
      } else {    
        this.value = value.toLocaleString('id-ID', {
          currency: 'IDR',
          style: 'currency',
          minimumFractionDigits: 0
        });
        cursorPostion = this.value.length - originalLenght + cursorPostion;
        this.setSelectionRange(cursorPostion, cursorPostion);
      }
    });
  });