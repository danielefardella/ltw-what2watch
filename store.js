import { loadState, saveState } from './localStorage';
import { createStore } from 'redux'; // using React JS store function

// Dobbiamo chiamare store.js e localStorage.js in index.php. Serve un render per store?

const persistedState = loadState();
const store = createStore(persistedState);
store.subscribe(() => { // we need a listener to be invoked when the state changes
    saveState(store.getState());
});