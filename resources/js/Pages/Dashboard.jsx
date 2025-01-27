import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout'
import { Head, Link, usePage } from '@inertiajs/react'
import Pagination from '@/Components/Pagination'

export default function Dashboard({ post }) {
    const user = usePage().props.auth.user
    return (
        <AuthenticatedLayout
            header={
                <h2 className="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                    Dashboard
                </h2>
            }
        >
            <Head title="Dashboard" />

            <div className="py-12">
                <div className="mx-auto max-w-3xl sm:px-6 lg:px-8">
                    <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                        <div className="dark:bg-gray-800 p-6 border border-gray-200 rounded-md shadow-md bg-gray-50 flex items-center space-x-2 justify-between">
                            <h3 className="text-xl font-semibold dark:text-gray-300 whitespace-nowrap">My Posts</h3>
                            <p className="text-3xl font-bold text-blue-600">{user.posts_count}</p>
                        </div>
                        <div className="dark:bg-gray-800 p-6 border border-gray-200 rounded-md shadow-md bg-gray-50 flex items-center space-x-2 justify-between">
                            <h3 className="text-xl font-semibold dark:text-gray-300 whitespace-nowrap">My Comments</h3>
                            <p className="text-3xl font-bold text-yellow-600">{user.comments_count}</p>
                        </div>
                        <div className="dark:bg-gray-800 p-6 border border-gray-200 rounded-md shadow-md bg-gray-50 flex items-center space-x-2 justify-between">
                            <h3 className="text-xl font-semibold dark:text-gray-300 whitespace-nowrap">My Friends</h3>
                            <p className="text-3xl font-bold text-yellow-600">{user.friend_count}</p>
                        </div>
                    </div>
                    <div>
                        {post.map((p) => {
                            return (
                                <div
                                    key={p.id}
                                    className='my-6 p-4 rounded bg-white dark:bg-gray-800 shadow-md'
                                >
                                    <div className='h-12 w-12 mr-4 border border-blue-500 rounded-full'>
                                        <img alt='avatar' src='' className='w-full h-full rounded-full object-cover' />
                                    </div>
                                    <div className='flex flex-col'>
                                        <Link href='#'>

                                        </Link>
                                    </div>
                                </div>
                            )
                        })}
                    </div>
                </div>
                {post && post.links && <Pagination links={post.links} />}
            </div>
        </AuthenticatedLayout>
    )
}
