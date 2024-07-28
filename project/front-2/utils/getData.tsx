export default async function getData(uri: string) {
    const API_URL = 'http://localhost:81';
    const path = `${API_URL}/${uri}`;

    try {
        const res = await fetch(path);
        if (!res.ok) {
            // Cela activera la plus proche Error Boundary `error.js`
            throw new Error(`Failed to fetch data : ${path}`);
        }
        const data = await res.json();
        console.log(data);

        return data;
    } catch (error) {
        // Gérer l'erreur ici
        console.error("Erreur lors de la récupération des données: ", error);
        throw error;
    }
}
