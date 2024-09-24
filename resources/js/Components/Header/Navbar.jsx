import React from 'react';
import logo from '../../../../public/images/logo/logo.png'
import { Link } from '@inertiajs/react';
import TextInput from '../TextInput';
import { Search,User,Mail,SquarePlay } from 'lucide-react';

const Navbar = () => {
    return (
    <header className='shadow-xl py-2'>
        <nav className='flex items-center justify-between w-[90%] mx-auto gap-10'>
            {/* logo */}
            <Link href='/'><img src={logo} alt="Logo" className='w-[70px] h-[50px]'/></Link>
            {/* Search */}
            <form className='flex gap-2'>
                <TextInput type='text' className="h-[40px] w-[500px] " placeholder="Search..."/>
                {/* <button type="submit" className='text-slate-50 font-extrabold text-sm px-1 bg-amber-500 rounded-sm'>
                    <Search size={30} color='white'/>
                </button> */}
                {/* <Search size={30} color='white' className='bg-blue-500 p-1 rounded-md cursor-pointer'/> */}
            </form>


            <div className='flex gap-5'>
                {/* contact */}
                <div className='text-amber-800'>
                    <Link href='/contact' className='font-mono font-black flex flex-col items-center gap-1 group'>
                        <Mail />
                        <span className='relative'>
                            Contact
                            <span className='absolute bottom-0 left-0 w-0 h-[2px] bg-amber-800 transition-all duration-300 ease-in-out group-hover:w-full'></span>
                        </span>
                    </Link>
                </div>
                {/* videos */}
                <div className='text-amber-800'>
                    <Link href='/videos' className='font-mono font-black flex flex-col items-center gap-1 group'>
                        <SquarePlay />
                        <span className='relative'>
                            Videos
                            <span className='absolute bottom-0 left-0 w-0 h-[2px] bg-amber-800 transition-all duration-300 ease-in-out group-hover:w-full'></span>
                        </span>
                    </Link>
                </div>
                {/* Login */}
                <div className='text-amber-800'>
                    <Link href='/login' className='font-mono font-black flex flex-col items-center gap-1 group'>
                        <User />
                        <span className='relative'>
                            Login
                            <span className='absolute bottom-0 left-0 w-0 h-[2px] bg-amber-800 transition-all duration-300 ease-in-out group-hover:w-full'></span>
                        </span>
                    </Link>
                </div>
            </div>
        </nav>
    </header>
    )
}

export default Navbar