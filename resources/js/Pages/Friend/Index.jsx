import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout"
import { Link, Head } from "@inertiajs/react"

const Index = ({ friends, not_friends }) => {
    return (
        <AuthenticatedLayout>
            <Head title="Your Friends" />
            <div className="w-full max-w-4xl mx-auto">
                <div className="p-6 space-y-8">
                    {/* Friends Section */}
                    <div>
                        <h2 className="text-xl font-bold text-gray-800 dark:text-gray-200 mb-4">
                            Friends
                        </h2>
                        <ul className="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4">
                            {friends.map((friend) => (
                                <li
                                    key={friend.id}
                                    className="flex flex-col items-center space-y-2 bg-white dark:bg-gray-800 p-4 rounded-lg shadow-md"
                                >
                                    <div className="h-20 w-20 rounded-full">
                                        <img
                                            src={friend.profile_pic}
                                            alt={friend.name}
                                            className="w-full h-full rounded-full object-cover"
                                        />
                                    </div>
                                    <Link href={route("users.show", friend.id)}>
                                        <p className="font-bold hover:underline dark:text-gray-100 flex flex-nowrap">{friend.name}</p>
                                    </Link>
                                </li>
                            ))}
                        </ul>
                    </div>
                    {/* People You May Know Section */}
                    <div>
                        <h2 className="text-xl font-bold text-gray-800 dark:text-gray-200 mb-4">
                            People You May Know
                        </h2>
                        <ul className="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4">
                            {not_friends.map((user) => (
                                <li
                                    key={user.id}
                                    className="flex flex-col items-center space-y-2 bg-white dark:bg-gray-800 p-4 rounded-lg shadow-md"
                                >
                                    <div className="h-20 w-20 rounded-full">
                                        <img
                                            src={user.profile_pic}
                                            alt={user.name}
                                            className="w-full h-full rounded-full object-cover"
                                        />
                                    </div>
                                    <Link href={route('users.show', user.id)}>
                                        <span className="font-bold hover:underline dark:text-gray-100 flex flex-nowrap">
                                            {user.name}
                                        </span>
                                    </Link>
                                </li>
                            ))}
                        </ul>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    )
}

export default Index