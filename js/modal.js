var btns = document.querySelectorAll(".modal_open_button");
for (let b of btns) {
  b.onclick = () => {
    let modal = b.parentElement.querySelector(".modal")
    let span = modal.querySelector(".close");
    modal.style.display = "block";
    document.querySelector('body').style.overflow="hidden";
    
    span.onclick = () => {
      modal.style.display = "none";
      document.querySelector('body').style.overflow="auto";
    }
    
    window.onclick = (event) => {
      if (event.target == modal) {
        modal.style.display = "none";
        document.querySelector('body').style.overflow="auto";
      }
    }
  }
}