<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <p class="font-bold text-2xl mb-4">{{ __("You are logged in as an Admin!") }}</p>

                    <!-- Text for performing tasks -->
                    <p class="text-lg text-gray-800 dark:text-gray-200">
                        You can perform the following tasks:
                    </p>

                    <!-- Navigation Links -->
                    <div class="mt-4">
                        <ul>
                            <li>
                                <a href="{{ route('subjects.index') }}" class="text-blue-500 hover:text-blue-700 font-semibold">
                                    Manage Subjects
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('chapters.index') }}" class="text-blue-500 hover:text-blue-700 font-semibold">
                                    Manage Chapters
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('revision-questions.index') }}" class="text-blue-500 hover:text-blue-700 font-semibold">
                                    Manage Revision Questions
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('mcquestions.index') }}"  class="text-blue-500 hover:text-blue-700 font-semibold">
                                    Manage Self-evaluation MCQ Questions
                                </a>
                            </li>
                            
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
