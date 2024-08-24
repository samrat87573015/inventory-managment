
function showLoder() {
  document.querySelector('#loder').classList.remove('!hidden');
}

function hideLoder() {
  document.querySelector('#loder').classList.add('!hidden');
}

function successTostr(msg) {
    Toastify({
        text: msg,
        duration: 3000,
        newWindow: true,
        close: true,
        gravity: "top", // `top` or `bottom`
        position: "right", // `left`, `center` or `right`
        stopOnFocus: true, // Prevents dismissing of toast on hover
        style: {
          background: "#2ecc71",
        },
      }).showToast();
}


function errorTostr(msg) {
    Toastify({
        text: msg,
        duration: 3000,
        newWindow: true,
        close: true,
        gravity: "top", // `top` or `bottom`
        position: "right", // `left`, `center` or `right`
        stopOnFocus: true, // Prevents dismissing of toast on hover
        style: {
          background: "#e74c3c",
        },
      }).showToast();
}



