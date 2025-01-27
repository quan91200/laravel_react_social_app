import InputError from '@/Components/InputError'
import Button from '@/Components/Button'
import TextInput from '@/Components/TextInput'
import GuestLayout from '@/Layouts/GuestLayout'
import { Head, useForm } from '@inertiajs/react'

export default function ForgotPassword({ status }) {
    const { data, setData, post, processing, errors } = useForm({
        email: '',
    })

    const submit = (e) => {
        e.preventDefault()

        post(route('password.email'))
    }

    return (
        <div className='dark:bg-gray-800 min-h-screen flex items-center justify-center'>
            <div className='max-w-4xl dark:bg-gray-900 p-5 rounded-md'>
                <GuestLayout>
                    <Head title="Forgot Password" />

                    <div className="mb-4 text-sm text-gray-600 dark:text-gray-400">
                        Forgot your password? No problem. Just let us know your email
                        address and we will email you a password reset link that will
                        allow you to choose a new one.
                    </div>

                    {status && (
                        <div className="mb-4 text-sm font-medium text-green-600 dark:text-green-400">
                            {status}
                        </div>
                    )}

                    <form onSubmit={submit}>
                        <TextInput
                            id="email"
                            type="email"
                            name="email"
                            value={data.email}
                            className="mt-1 block w-full"
                            isFocused={true}
                            onChange={(e) => setData('email', e.target.value)}
                        />

                        <InputError message={errors.email} className="mt-2" />

                        <div className="my-4 flex items-center justify-end">
                            <Button disabled={processing} variant='outlineWarning'>
                                Email Password Reset Link
                            </Button>
                        </div>
                    </form>
                </GuestLayout>
            </div>
        </div>
    )
}
