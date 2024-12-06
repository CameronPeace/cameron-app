import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head } from '@inertiajs/react';
import { TheaterData } from '../Components/TheaterData';

export default function Theater({ auth }) {
    return (
        <AuthenticatedLayout
            user={auth.user}
            header={<h2 className="font-semibold text-xl text-gray-800 leading-tight">Top Theaters</h2>}
        >
            <Head title="Top Theaters" />

            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div className="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <TheaterData/>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
