import ApplicationLogo from '@/Components/ApplicationLogo'
import Dropdown from '@/Components/Dropdown'
import NavLink from '@/Components/NavLink'
import ResponsiveNavLink from '@/Components/ResponsiveNavLink'
import { Link, usePage } from '@inertiajs/react'
import { useState } from 'react'
import { IoIosNotificationsOutline } from "react-icons/io"
import { CiMail } from "react-icons/ci"

export default function AuthenticatedLayout({ header, children }) {
    const auth = usePage().props.auth.user
    const [showingNavigationDropdown, setShowingNavigationDropdown] =
        useState(false)
    return (
        <div className="min-h-screen bg-gray-100 dark:bg-gray-900">
            <nav className="border-b border-gray-100 bg-white dark:border-gray-700 dark:bg-gray-800 fixed top-0 w-full z-10">
                <div className="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                    <div className="flex h-16 justify-between">
                        <div className="flex">
                            <div className="flex shrink-0 items-center">
                                <Link href="/">
                                    <ApplicationLogo className="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
                                </Link>
                            </div>

                            <div className="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                                <NavLink
                                    href={route('dashboard')}
                                    active={route().current('dashboard')}
                                >
                                    Dashboard
                                </NavLink>
                                <NavLink
                                    href={route('posts.index')}
                                    active={route().current('posts.index')}
                                >
                                    Post
                                </NavLink>
                            </div>
                        </div>

                        <div className="hidden sm:ms-6 sm:flex sm:items-center">
                            <div className="relative flex items-center space-x-3">
                                <div className='h-8 w-8 flex items-center justify-center border border-gray-500 dark:text-gray-500 dark:hover:border-gray-300 dark:hover:text-gray-300 rounded cursor-pointer'>
                                    <CiMail size={20} />
                                </div>
                                <Dropdown>
                                    <Dropdown.Trigger>
                                        <div className='h-8 w-8 flex items-center justify-center border border-gray-500 dark:text-gray-500 dark:hover:border-gray-300 dark:hover:text-gray-300 rounded cursor-pointer'>
                                            <IoIosNotificationsOutline size={20} />
                                        </div>
                                    </Dropdown.Trigger>
                                    <Dropdown.Content>
                                        Mon ngu
                                    </Dropdown.Content>
                                </Dropdown>
                                <Dropdown>
                                    <Dropdown.Trigger>
                                        <span className="inline-flex">
                                            <button
                                                type="button"
                                                className="transition duration-150 ease-in-out"
                                            >
                                                <div className='h-10 w-10'>
                                                    <img
                                                        alt='avt'
                                                        src={
                                                            auth.profile_pic ? `/storage/${auth.profile_pic}`
                                                                : null
                                                        }
                                                        className='
                                                            object-cover w-full h-full rounded-full border-2 
                                                            border-blue-500'
                                                    />
                                                </div>
                                            </button>
                                        </span>
                                    </Dropdown.Trigger>

                                    <Dropdown.Content>
                                        <Dropdown.Link
                                            href={route('users.show', auth.id)}
                                        >
                                            {auth.name}
                                        </Dropdown.Link>
                                        <Dropdown.Link
                                            href={route('logout')}
                                            method="post"
                                            as="button"
                                        >
                                            Log Out
                                        </Dropdown.Link>
                                    </Dropdown.Content>
                                </Dropdown>
                            </div>
                        </div>

                        <div className="-me-2 flex items-center sm:hidden">
                            <button
                                onClick={() =>
                                    setShowingNavigationDropdown(
                                        (previousState) => !previousState,
                                    )
                                }
                                className="inline-flex items-center justify-center rounded-md p-2 
                                         text-gray-400 transition duration-150 ease-in-out 
                                         hover:bg-gray-100 hover:text-gray-500 focus:bg-gray-100 
                                         focus:text-gray-500 focus:outline-none dark:text-gray-500 
                                         dark:hover:bg-gray-900 dark:hover:text-gray-400 
                                         dark:focus:bg-gray-900 dark:focus:text-gray-400"
                            >
                                <svg
                                    className="h-6 w-6"
                                    stroke="currentColor"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        className={
                                            !showingNavigationDropdown
                                                ? 'inline-flex'
                                                : 'hidden'
                                        }
                                        strokeLinecap="round"
                                        strokeLinejoin="round"
                                        strokeWidth="2"
                                        d="M4 6h16M4 12h16M4 18h16"
                                    />
                                    <path
                                        className={
                                            showingNavigationDropdown
                                                ? 'inline-flex'
                                                : 'hidden'
                                        }
                                        strokeLinecap="round"
                                        strokeLinejoin="round"
                                        strokeWidth="2"
                                        d="M6 18L18 6M6 6l12 12"
                                    />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <div
                    className={
                        (showingNavigationDropdown ? 'block' : 'hidden') +
                        ' sm:hidden'
                    }
                >
                    <div className="space-y-1 pb-3 pt-2">
                        <ResponsiveNavLink
                            href={route('dashboard')}
                            active={route().current('dashboard')}
                        >
                            Dashboard
                        </ResponsiveNavLink>
                    </div>

                    <div className="border-t border-gray-200 pb-1 pt-4 dark:border-gray-600">
                        <div className="px-4">
                            <div className="text-base font-medium text-gray-800 dark:text-gray-200">
                                {auth.name}
                            </div>
                            <div className="text-sm font-medium text-gray-500">
                                {auth.email}
                            </div>
                        </div>

                        <div className="mt-3 space-y-1">
                            <ResponsiveNavLink
                                method="post"
                                href={route('logout')}
                                as="button"
                            >
                                Log Out
                            </ResponsiveNavLink>
                        </div>
                    </div>
                </div>
            </nav>

            {header && (
                <header className="bg-white shadow dark:bg-gray-800">
                    <div className="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
                        {header}
                    </div>
                </header>
            )}

            <main className='pt-16 pb-4'>{children}</main>
        </div>
    )
}
