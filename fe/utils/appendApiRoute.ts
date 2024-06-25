export const appendApiRoute = (route: string) => {
    const { apiUrl, apiVersion } = useRuntimeConfig();
    return `${apiUrl}/${apiVersion}${route}`;
}
