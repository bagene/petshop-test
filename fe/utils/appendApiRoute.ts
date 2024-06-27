export const appendApiRoute = (route: string) => {
    const { apiUrl, apiVersion } = useRuntimeConfig();
    console.log(apiUrl, apiVersion);
    return `${apiUrl}/${apiVersion}${route}`;
}
