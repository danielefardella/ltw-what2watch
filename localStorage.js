export const loadState = () => {
    try {
        const savedState = localStorage.getItem('state');
        if (savedState === null) {
            return undefined;
        }
        return JSON.parse(savedState); // if the savedState string exists (it's not null), we turn it into a JS object
    } catch (error) {
        return undefined;
    }
};

export const saveState = (state) => {
    try {
        const savedState = JSON.stringify(state);
        localStorage.setItem('state', saveState);
    } catch (error) {}
};