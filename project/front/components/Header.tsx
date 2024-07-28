'use client'
import Link from "next/link";
import {usePathname} from "next/navigation";

const Header = () => {
    return (
        <header className='bg-white'>
            <div className="navbar bg-base-100">
                <div className="flex-1">
                    <a className="btn btn-ghost text-xl">Boris MZK Test</a>
                </div>
            </div>
        </header>
    );
};

export default Header;
