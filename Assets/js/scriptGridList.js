// Grid Function 

function grid() {
    container.classList.add('grid'); // Add the 'grid' class to container
    container.classList.remove('list'); // Remove the 'list' class from container
    switchGritToList.classList.add('listIcon'); // Add the 'listIcon' from class
    switchGritToList.classList.remove('gridIcon'); // Remove the 'gridIcon' from class
    
    // Move images with class name 'imgPL' to the right
    const listImages = document.querySelectorAll('.imgPL');
    listImages.forEach(image => {
      // Remove previous positioning class
      image.classList.add('imgPl');
  
      // Apply new positioning class
      image.classList.remove('listImg');
    });
  
    const text = document.querySelectorAll('.h3PL');
    text.forEach(text => {
  
     text.classList.add('h3Pl');
  
     text.classList.remove('textList');
    });
  
    const text1 = document.querySelectorAll('.pPL');
     text1.forEach(text => {
  
      text.classList.add('pPl');
  
      text.classList.remove('textList1');
     });
  
     const text2 = document.querySelectorAll('.h5PL');
     text2.forEach(money => {
  
      money.classList.add('h5Pl');
  
      money.classList.remove('money');
     });
  
     const showMoreBtn = document.querySelectorAll('.show_more');
     showMoreBtn.forEach(btn => {
  
      btn.classList.add('button');
  
      btn.classList.remove('showMoreBtnList');
     });
  
     
    }
  
  function list() {
    container.classList.add('list'); // Add the 'list' class to container
    container.classList.remove('grid'); // Remove the 'grid' class from container
    switchGritToList.classList.add('gridIcon'); // Add the 'gridIcon' from class
    switchGritToList.classList.remove('listIcon'); // Remove the 'listIcon' from class
  
     // Move images with class name 'imgPL' to the right
     const listImages = document.querySelectorAll('.imgPL');
     listImages.forEach(image => {
       // Remove previous positioning class
       image.classList.remove('imgPl');
   
       // Apply new positioning class
       image.classList.add('listImg');
     });
     
     const text = document.querySelectorAll('.h3PL');
     text.forEach(text => {
  
      text.classList.remove('h3Pl');
  
      text.classList.add('textList');
     });
  
     const text1 = document.querySelectorAll('.pPL');
     text1.forEach(text => {
  
      text.classList.remove('pPl');
  
      text.classList.add('textList1');
     });
  
     const text2 = document.querySelectorAll('.h5PL');
     text2.forEach(money => {
  
      money.classList.remove('h5Pl');
  
      money.classList.add('money');
     });
  
     const showMoreBtn = document.querySelectorAll('.show_more');
     showMoreBtn.forEach(btn => {
  
      btn.classList.remove('button');
  
      btn.classList.add('showMoreBtnList');
     });
     
  }
  
  
  
  // Grid Button
  let isRowLayout = true;
  
  const container = document.querySelector('.divContainProducts');
  const switchGritToList = document.querySelector('.gridImg');
  
  function toggleLayout() {
    if (isRowLayout) {
      grid(); // Call the grid function to switch to grid layout
    } else {
      list(); // Call the list function to switch to list layout
    }
  
    isRowLayout = !isRowLayout; // Toggle the layout flag
  }
  