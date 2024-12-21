//DOM elements
const DOMstrings = {
  stepsBtnClass: 'multisteps-form__progress-btn',
  stepsBtns: document.querySelectorAll(`.multisteps-form__progress-btn`),
  stepsBar: document.querySelector('.multisteps-form__progress'),
  stepsForm: document.querySelector('.multisteps-form__form'),
  stepsFormTextareas: document.querySelectorAll('.multisteps-form__textarea'),
  stepFormPanelClass: 'multisteps-form__panel',
  stepFormPanels: document.querySelectorAll('.multisteps-form__panel'),
  stepPrevBtnClass: 'js-btn-prev',
  stepNextBtnClass: 'js-btn-next'
};

//remove class from a set of items
const removeClasses = (elemSet, className) => {
  elemSet.forEach(elem => {
    elem.classList.remove(className);
  });
};

//return exact parent node of the element
const findParent = (elem, parentClass) => {
  let currentNode = elem;
  while (!currentNode.classList.contains(parentClass)) {
    currentNode = currentNode.parentNode;
  }
  return currentNode;
};

//get active button step number
const getActiveStep = elem => {
  return Array.from(DOMstrings.stepsBtns).indexOf(elem);
};

//set all steps before clicked (and clicked too) to active
const setActiveStep = activeStepNum => {
  //remove active state from all the state
  removeClasses(DOMstrings.stepsBtns, 'js-active');

  //set picked items to active
  DOMstrings.stepsBtns.forEach((elem, index) => {
    if (index <= activeStepNum) {
      elem.classList.add('js-active');
    }
  });
};

//get active panel
const getActivePanel = () => {
  let activePanel;
  DOMstrings.stepFormPanels.forEach(elem => {
    if (elem.classList.contains('js-active')) {
      activePanel = elem;
    }
  });
  return activePanel;
};

//open active panel (and close unactive panels)
const setActivePanel = activePanelNum => {
  //remove active class from all the panels
  removeClasses(DOMstrings.stepFormPanels, 'js-active');

  //show active panel
  DOMstrings.stepFormPanels.forEach((elem, index) => {
    if (index === activePanelNum) {
      elem.classList.add('js-active');
      setFormHeight(elem);
    }
  });
};

//set form height equal to current panel height
const formHeight = activePanel => {
  const activePanelHeight = activePanel.offsetHeight;
  DOMstrings.stepsForm.style.height = `${activePanelHeight}px`;
};

const setFormHeight = () => {
  const activePanel = getActivePanel();
  formHeight(activePanel);
};

// Go to next step (programmatically triggered)
const goToNextStep = () => {
  const activePanel = getActivePanel();
  let activePanelNum = Array.from(DOMstrings.stepFormPanels).indexOf(activePanel);

  activePanelNum++; // move to next step
  if (activePanelNum < DOMstrings.stepFormPanels.length) {
    setActiveStep(activePanelNum);
    setActivePanel(activePanelNum);
  }
};

// Go to previous step (programmatically triggered)
const goToPrevStep = () => {
  const activePanel = getActivePanel();
  let activePanelNum = Array.from(DOMstrings.stepFormPanels).indexOf(activePanel);

  activePanelNum--; // move to previous step
  if (activePanelNum >= 0) {
    setActiveStep(activePanelNum);
    setActivePanel(activePanelNum);
  }
};

// Prevent default button click behavior (no navigation)
const preventButtonNavigation = (e) => {
  e.preventDefault(); // Prevent the button from navigating directly
};

// Attach preventDefault to next and prev buttons
DOMstrings.stepsForm.addEventListener('click', e => {
  const eventTarget = e.target;

  // Check if the clicked element is a "Next" or "Prev" button
  if (eventTarget.classList.contains(DOMstrings.stepPrevBtnClass) || eventTarget.classList.contains(DOMstrings.stepNextBtnClass)) {
    preventButtonNavigation(e); // Prevent default navigation behavior
  }
});

// Example of how to programmatically trigger navigation
const exampleFunction = () => {
  // some logic here
  goToNextStep();  // You can call this function when needed
};

// Example of how to programmatically trigger navigation
const anotherFunction = () => {
  // some logic here
  goToPrevStep();  // You can call this function when needed
};

//SETTING PROPER FORM HEIGHT ONLOAD
window.addEventListener('load', setFormHeight, false);

//SETTING PROPER FORM HEIGHT ONRESIZE
window.addEventListener('resize', setFormHeight, false);

//changing animation via animation select !!!YOU DON'T NEED THIS CODE (if you want to change animation type, just change form panels data-attr)
const setAnimationType = newType => {
  DOMstrings.stepFormPanels.forEach(elem => {
    elem.dataset.animation = newType;
  });
};

//selector onchange - changing animation
const animationSelect = document.querySelector('.pick-animation__select');

animationSelect.addEventListener('change', () => {
  const newAnimationType = animationSelect.value;
  setAnimationType(newAnimationType);
});
