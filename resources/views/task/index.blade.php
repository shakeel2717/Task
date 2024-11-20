<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Task Management Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f6f9;
        }

        .task-card {
            transition: all 0.3s ease;
        }

        .task-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .task-completed {
            text-decoration: line-through;
            opacity: 0.6;
        }
    </style>
</head>

<body>
    <div class="container-fluid bg-primary py-3">
        <div class="container">
            <h2 class="text-white text-center">Task Management</h2>
        </div>
    </div>

    <div class="container mt-4">
        <div class="row">
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Create New Task</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('tasks.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Task Title</label>
                                <input type="text" name="title" class="form-control" placeholder="Enter task title"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Description</label>
                                <textarea class="form-control" name="description" rows="3" placeholder="Task description (optional)"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="bi bi-plus-circle me-2"></i>Add Task
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header d-flex justify-content-between align-items-center bg-white">
                        <h5 class="mb-0">Task List</h5>
                        <div class="btn-group" role="group">
                            <button class="btn btn-sm btn-outline-primary">All</button>
                            <button class="btn btn-sm btn-outline-success">Active</button>
                            <button class="btn btn-sm btn-outline-secondary">Completed</button>
                        </div>
                    </div>
                    <div class="card-body" style="max-height: 500px; overflow-y: auto;">
                        @forelse ($tasks as $task)
                            <div class="card task-card mb-3">
                                <div class="card-body d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="mb-1">{{ $task->title }}</h6>
                                        <small class="text-muted d-block">{{ $task->description }}</small>
                                        <span class="badge bg-primary mt-2 text-uppercase">{{ $task->status }}</span>
                                        <small class="ms-2 text-muted">Created: {{ $task->created_at }}</small>
                                    </div>
                                    <div class="btn-group" role="group">
                                        <form action="{{ route('tasks.complete', $task) }}" method="POST">
                                            @csrf
                                            <button class="btn btn-sm btn-outline-success">
                                                <i class="bi bi-check-circle"></i>
                                            </button>
                                        </form>
                                        <a href="{{ route('tasks.edit', $task) }}"
                                            class="btn btn-sm btn-outline-primary">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="{{ route('tasks.destroy', $task) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-outline-danger">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <!-- More Task Items Can Be Added Here -->
                            <div class="text-center text-muted py-4" id="emptyState">
                                <i class="bi bi-list-task fs-1 mb-3"></i>
                                <p>No tasks found. Start adding your tasks!</p>
                            </div>
                        @endforelse

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
