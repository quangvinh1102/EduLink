// resources/js/firebase.js
import { initializeApp } from 'firebase/app';
import { getDatabase, ref, push, onValue, child, get } from 'firebase/database';

const firebaseConfig = {
    apiKey: "AIzaSyBIKj0U1U6vh9pM3BZc1NHJi9ppUBy7wpA",
    authDomain: "chat-module-8e64e.firebaseapp.com",
    projectId: "chat-module-8e64e",
    storageBucket: "chat-module-8e64e.appspot.com",
    messagingSenderId: "1063893624468",
    appId: "1:1063893624468:web:f1a32b5acfcc0003c8b681",
    databaseURL: "https://chat-module-8e64e-default-rtdb.firebaseio.com",
};

const app = initializeApp(firebaseConfig);
const database = getDatabase(app);

export { database, ref, push, onValue, child, get };
