<x-dashboard-layout>
    @section('content')
        <div class="container mt-4">
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            Filter Questions
                        </div>
                        <div class="card-body">
                            <form method="GET" action="{{ route('usermodule.revisionquestions') }}">
                                <div class="form-group">
                                    <label for="subject">Select Subject</label>
                                    <select class="form-control" id="subject" name="subject_id" style="width: 100%;">
                                        @foreach ($subjects as $subject)
                                            <option value="{{ $subject->id }}"
                                                {{ $subject->id == $selectedSubject ? 'selected' : '' }}>
                                                {{ $subject->SName }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="chapter">Select Chapter</label>
                                    <select class="form-control" id="chapter" name="chapter_id" style="width: 100%;">
                                        @foreach ($chapters as $chapter)
                                            <option value="{{ $chapter->id }}"
                                                {{ $chapter->id == $selectedChapter ? 'selected' : '' }}>
                                                {{ $chapter->CName }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary" style="width: 100%;">Search</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            Image and Additional Panel
                        </div>
                        <div class="container mt-4">
                            <div class="question-box">
                                @foreach ($revisionQuestions as $question)
                                    <div class="question-container">
                                        <div class="image-and-additional-container" style="display: flex;">
                                            <div class="image-container"
                                                style="border: 1px solid #ddd; padding: 10px; margin-top: 10px; max-height: 500px; overflow-y: auto; flex: 1;">
                                                @if ($question->QImage)
                                                    <div class="image-box"
                                                        style="max-width: 100%; margin: 0; flex-shrink: 0;">
                                                        <img src="{{ asset('storage/' . $question->QImage) }}"
                                                            alt="Question Image"
                                                            class="question-image question-{{ $question->id }}"
                                                            style="max-width: 100%;">
                                                    </div>
                                                @else
                                                    <p>No question image available</p>
                                                @endif

                                                @if ($question->AImage)
                                                    <div class="image-box"
                                                        style="max-width: 100%; margin: 0; flex-shrink: 0;">
                                                        <img src="{{ asset('storage/' . $question->AImage) }}"
                                                            alt="Answer Image"
                                                            class="answer-image answer-{{ $question->id }}"
                                                            style="display: none; max-width: 100%;">
                                                    </div>
                                                @else
                                                    <p>No answer image available</p>
                                                @endif
                                            </div>

                                            <!-- Additional Container on the right -->
                                            <div class="additional-container"
                                                style="border: 1px solid #ddd; padding: 10px; margin-top: 10px; max-height: 500px; overflow-y: auto; flex: 1;">
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input toggle"
                                                        id="toggle-{{ $question->id }}">
                                                    <label class="form-check-label"
                                                        for="toggle-{{ $question->id }}">Toggle
                                                        Question/Answer</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <button id="openSketchpadButton">Open Sketchpad</button>
        <div id="sketchpadModal">
            <div id="sketchpadContent">
                <canvas id="sketchpad" width="500" height="500"></canvas>
                <br>
                <input type="color" id="colorPicker" value="#000000">
                <br>
                <button id="eraserButton">Toggle Eraser</button>
                <button id="clearButton">Erase Everything</button>
                <br>
                <button id="closeSketchpadButton">Close Sketchpad</button>
            </div>
        </div>
    </x-dashboard-layout>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const openSketchpadButton = document.getElementById('openSketchpadButton');
            const closeSketchpadButton = document.getElementById('closeSketchpadButton');
            const sketchpadModal = document.getElementById('sketchpadModal');
            const sketchpad = document.getElementById('sketchpad');
            const colorPicker = document.getElementById('colorPicker');
            const ctx = sketchpad.getContext('2d');
            let eraserMode = false;
            let painting = false;

            openSketchpadButton.addEventListener('click', function () {
                sketchpadModal.style.display = 'flex';
            });

            closeSketchpadButton.addEventListener('click', function () {
                sketchpadModal.style.display = 'none';
            });

            function getMousePos(canvas, e) {
                const rect = canvas.getBoundingClientRect();
                return {
                    x: e.clientX - rect.left,
                    y: e.clientY - rect.top
                };
            }

            function startPosition(e) {
                painting = true;
                const pos = getMousePos(sketchpad, e);
                draw(pos);
            }

            function endPosition() {
                painting = false;
                ctx.beginPath();
            }

            function draw(pos) {
                if (!painting) return;

                ctx.lineWidth = 5;
                ctx.lineCap = 'round';

                if (eraserMode) {
                    ctx.strokeStyle = '#fff'; // Set color to white for eraser
                } else {
                    ctx.strokeStyle = colorPicker.value; // Set stroke color to the selected color
                }

                ctx.lineTo(pos.x, pos.y);
                ctx.stroke();
                ctx.beginPath();
                ctx.moveTo(pos.x, pos.y);
            }

            function toggleEraser() {
                eraserMode = !eraserMode;
            }

            function clearCanvas() {
                // Clear the entire canvas
                ctx.clearRect(0, 0, sketchpad.width, sketchpad.height);
            }

            sketchpad.addEventListener('mousedown', startPosition);
            sketchpad.addEventListener('mouseup', endPosition);
            sketchpad.addEventListener('mousemove', function (e) {
                const pos = getMousePos(sketchpad, e);
                draw(pos);
            });

            document.getElementById('eraserButton').addEventListener('click', toggleEraser);
            document.getElementById('clearButton').addEventListener('click', clearCanvas);
        });

        // Function to update chapters based on the selected subject
        function updateChapters(subjectId) {
            $.ajax({
                url: '/get-chapters/' + subjectId,
                method: 'GET',
                success: function (data) {
                    // Update the chapters dropdown with the fetched chapters
                    $('#chapter').empty();
                    $('#chapter').append($('<option>', {
                        value: '',
                        text: 'Select a Chapter'
                    }));
                    $.each(data, function (key, value) {
                        $('#chapter').append($('<option>', {
                            value: key,
                            text: value
                        }));
                    });
                }
            });
        }

        // Initialize chapters based on the selected subject
        var initialSubjectId = $('#subject').val();
        updateChapters(initialSubjectId);

        // When the subject dropdown changes, update the chapters
        $('#subject').change(function () {
            var subjectId = $(this).val();
            updateChapters(subjectId);
        });

        // Toggle question/answer images when the checkbox changes
        $('.toggle').change(function () {
            var questionId = $(this).attr('id').split('-')[1];
            if ($(this).is(':checked')) {
                // Show answer image and hide question image when checkbox is checked
                $('.question-' + questionId).hide();
                $('.answer-' + questionId).show();
            } else {
                // Show question image and hide answer image when checkbox is unchecked
                $('.question-' + questionId).show();
                $('.answer-' + questionId).hide();
            }
        });
    </script>
    <style>
        body {
            /* display: flex;
            justify-content: center;
            align-items: center; */
            height: 100vh;
            margin: 0;
        }

        canvas {
            border: 10px solid #000;
        }

        #openSketchpadButton {
            position: fixed;
            top: 65px;
            right: 10px;
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
        }

        /* Styling for the modal */
        #sketchpadModal {
            display: none;
            position: fixed;
            top: 0;
            left: auto;
            right: 0;
            width: 50%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            justify-content: center;
            align-items: center;
        }

        #eraserButton,
        #clearButton,
        #closeSketchpadButton {
            background-color: #ddd;
            border: none;
            color: #000;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
        }

        #sketchpadContent {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            text-align: center;
        }

        #colorPicker {
            margin-bottom: 15px;
        }
    </style>

