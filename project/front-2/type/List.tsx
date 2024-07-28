export interface ISource {
    name: string;
    slug: string;
}

export interface IArticle {
    sourceName: string;
    title: string;
    content: string;
    author: string;
    date: Date;
}
