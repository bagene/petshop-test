import {defineStore} from "pinia";

export const errorStore = defineStore('error', () => {
    const globalError = ref<string | null>(null);
    const errors = ref<{ [key: string]: string[] }>({});

    const setGlobalError = (error: string) => {
        globalError.value = error;
    }

    const clearErrors = () => {
        errors.value = {};
        globalError.value = null;
    }

    const setErrors = (newErrors: { [key: string]: string[] }) => {
        errors.value = newErrors;
    }

    const removeError = (key: string) => {
        delete errors.value[key];
    }

    return {
        globalError,
        errors,
        setGlobalError,
        clearErrors,
        setErrors,
        removeError,
        hasGlobalError: computed(() => !!globalError.value),
    };
});
