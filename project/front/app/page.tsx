'use client'
;
import {useState, useEffect, Suspense} from 'react';
import getData from '@/utils/getData';
import {IArticle, ISource} from "@/type/List";

function Select({onSourceChange}: { onSourceChange: (source: string) => void }) {
    const [sources, setSources] = useState<ISource[]>([]);

    useEffect(() => {
        const fetchSources = async () => {
            const result = await getData('api/sources.json');
            setSources(result);
        };
        fetchSources();
    }, []);

    return (
        <select
            className="select select-primary w-full max-w-xs"
            onChange={(e) => onSourceChange(e.target.value)}
        >
            <option value="">Tous</option>
            {Array.isArray(sources) && sources.map((item: ISource, index: number) => (
                <option key={index} value={item.slug}>{item.name}</option>
            ))}
        </select>
    );
}

function Articles({source}: { source: string }) {
    const [articles, setArticles] = useState<IArticle[]>([]);

    useEffect(() => {
        const fetchArticles = async () => {
            const uri = source ? `api/articles.json?source=${source}` : 'api/articles.json';
            const result = await getData(uri);
            setArticles(result);
        };
        fetchArticles();
    }, [source]);

    return (
        <>
            {Array.isArray(articles) && articles.map((item: IArticle, index: number) => (
                <div key={index} className="collapse bg-base-200 mb-20">
                    <input type="radio" name="my-accordion-1" defaultChecked={index === 0} />
                    <div className="collapse-title text-xl font-medium">{item.sourceName} - {item.author} - {item.title}</div>
                    <div className="collapse-content">
                        <p>{item.content}</p>
                    </div>
                </div>
            ))}
        </>
    );
}

export default function Home() {
    const [source, setSource] = useState<string>('');

    const handleSourceChange = (newSource: string) => {
        setSource(newSource);
    };

    return (
        <main className="flex min-h-screen flex-col items-center justify-between p-24">
            <Suspense fallback={<p className="text-black">Loading sources...</p>}>
                <Select onSourceChange={handleSourceChange} />
            </Suspense>
            <div className="divider divider-neutral">Articles :</div>
            <Suspense fallback={<p className="text-black">Loading articles...</p>}>
                <Articles source={source} />
            </Suspense>
        </main>
    );
}
