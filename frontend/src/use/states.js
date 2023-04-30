/*
export const getBaseApiUrl = () => {
    return import.meta.env.VITE_VUE_APP_BACKEND_ENDPOINT
}*/

import {ref} from "vue";

export const baseApiUrl = 'http://127.0.0.1:8097/api/v1';

export const isValidated = ref(false)
export const errorMessage = ref('')

export const validateFormData = (dataForm) => {
    let messages = []

    if (dataForm.title === '') {
        messages.push('title is empty')
    }
    if (dataForm.description === '') {
        messages.push('description is empty')
    }
    if (dataForm.content === '') {
        messages.push('content is empty')
    }
    if (dataForm.author === '') {
        messages.push('author is empty')
    }

    if (messages.length > 0) {
        isValidated.value = false
        errorMessage.value = 'Error validation: ' + messages.join(',')
    } else {
        isValidated.value = true
        errorMessage.value = ''
    }
}

export function checkAuth(store) {
    //console.log('checkAuth')
    if (!store.getters["auth/GET_AUTHENTICATED"]) {
        //router.push('login')
        return false
    } else {
        return true
    }
}
