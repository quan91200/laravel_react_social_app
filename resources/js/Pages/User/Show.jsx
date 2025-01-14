import React from 'react'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout'
import { FaLinkedin } from "react-icons/fa"
import { FaSquareFacebook } from "react-icons/fa6"
import { IoLogoYoutube } from "react-icons/io"
import { FaSquareGithub } from "react-icons/fa6"

const Show = ({ user }) => {
    console.log(user.data)
    return (
        <AuthenticatedLayout
        >
            <div className=''>
                <div className='flex items-center flex-col relative'>
                    <div className='dark:bg-gray-700 w-full absolute h-40'></div>
                    <div className='z-10 flex items-center justify-between h-64 max-w-6xl w-full mx-auto px-4 sm:px-6 lg:px-8'>
                        <div className='flex items-center gap-4'>
                            <div className='lg:h-40 lg:w-40 sm:h-28 sm:w-28 border dark:border-blue-700 rounded-full'>
                                <img
                                    alt='Avatar'
                                    src={user.data.profile_pic}
                                    className='w-full h-full object-cover rounded-full'
                                />
                            </div>
                            <div className='flex flex-col items-start dark:text-gray-50'>
                                <h2 className='font-bold text-xl'>{user.data.name}</h2>
                                <h4>{user.data.friend_count} friends</h4>
                            </div>
                        </div>
                        <div className='flex items-center space-x-3'>
                            <FaLinkedin size={28} className='text-blue-400 hover:scale-110 transition cursor-pointer' />
                            <FaSquareFacebook size={28} className='text-blue-600 hover:scale-110 transition cursor-pointer' />
                            <IoLogoYoutube size={28} className='text-red-600 hover:scale-110 transition cursor-pointer' />
                            <FaSquareGithub size={28} className='text-violet-400 hover:scale-110 transition cursor-pointer' />
                        </div>
                    </div>
                    <div className='max-w-4xl dark:bg-gray-700 w-full dark:text-gray-50'>
                        <div className='p-4'>
                            <h2>Information</h2>
                            <p className='capitalize'>Job: {user.data.job}</p>
                            <p className='capitalize'>Address: {user.data.address}</p>
                            <p className='capitalize'>Phone: {user.data.phone_number}</p>
                            <p className='capitalize'>Hobbies: {user.data.hobbies}</p>
                            <p className='capitalize'>Email: {user.data.email}</p>
                        </div>
                    </div>
                    <div>hello</div>
                </div>
            </div>
        </AuthenticatedLayout>
    )
}

export default Show