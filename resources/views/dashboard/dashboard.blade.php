<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    <!-- Add your styles and scripts here -->

    <!-- Styles -->
    <style>
        /* Add your styles here */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f7fafc;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
        }

        .dashboard-layout {
            background-color: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .dashboard-header {
            padding: 20px;
            text-align: center;
            border-bottom: 1px solid #e2e8f0;
        }

        .dashboard-title {
            font-size: 1.5rem;
            font-weight: bold;
            color: #4a5568;
        }

        .dashboard-content {
            padding: 20px;
            text-align: center;
        }

        .dashboard-card {
            background-color: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 20px;
            text-align: center;
            margin-bottom: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .dashboard-number {
            font-size: 2.5rem;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .dashboard-label {
            font-size: 1.2rem;
            color: #4a5568;
        }

        .dashboard-container {
            display: flex;
            justify-content: space-around;
            margin-top: 2rem;
        }

        .dashboard-item {
            text-align: center;
            padding: 3.5rem;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease-in-out;
        }

        .dashboard-item:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 12px rgba(0, 0, 0, 0.2);
        }

        .dashboard-number {
            font-size: 4.5rem;
            font-weight: bold;
        }

        .dashboard-label {
            margin-top: 0.5rem;
            font-size: 1.2rem;
            color: #555;
        }
    </style>
</head>

<body class="antialiased">
    <x-dashboard-layout>

        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Dashboard') }}
            </h2>
        </x-slot>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        {{ __("You're logged in!") }}

                        <div class="dashboard-container">
                            <div class="dashboard-item">
                                <h2 class="dashboard-number" id="subChapMcqNumber">0</h2>
                                <p class="dashboard-label">Self-Evaluating MCQ</p>
                            </div>
                            <div class="dashboard-item">
                                <h2 class="dashboard-number" id="revisionQNumber">0</h2>
                                <p class="dashboard-label">Revision Questions</p>
                            </div>
                            <div class="dashboard-item">
                                <h2 class="dashboard-number" id="subjectNumber">0</h2>
                                <p class="dashboard-label">Subjects</p>
                            </div>
                            <div class="dashboard-item">
                                <h2 class="dashboard-number" id="chapterNumber">0</h2>
                                <p class="dashboard-label">Chapters</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-dashboard-layout>

    <!-- Scripts -->
    <script defer>
        document.addEventListener('DOMContentLoaded', function () {
            function fetchDataAndUpdateNumbers() {
                const apiUrl = '/get-counts';

                fetch(apiUrl)
                    .then(response => response.json())
                    .then(data => {
                        updateNumbers(data);
                    })
                    .catch(error => console.error('Error fetching data:', error));
            }

            function updateNumbers(data) {
                animateNumber(document.getElementById('subChapMcqNumber'), 0, data.subChapMcqCount, 3);
                animateNumber(document.getElementById('revisionQNumber'), 0, data.revisionQCount, 3);
                animateNumber(document.getElementById('subjectNumber'), 0, data.subjectCount, 3);
                animateNumber(document.getElementById('chapterNumber'), 0, data.chapterCount, 3);
            }

            function animateNumber(element, startNumber, endNumber, duration) {
                let currentNumber = startNumber;
                const increment = (endNumber - startNumber) / duration;
                const interval = setInterval(() => {
                    currentNumber += increment;
                    element.innerText = Math.round(currentNumber);
                    if (currentNumber >= endNumber) {
                        element.innerText = endNumber;
                        clearInterval(interval);
                    }
                }, 10000 / 60);
            }

            // Initial fetch and update
            fetchDataAndUpdateNumbers();

            // Fetch and update every 5 seconds (adjust as needed)
            setInterval(fetchDataAndUpdateNumbers, 10000);
        });
    </script>
</body>

</html>
