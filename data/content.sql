INSERT INTO user (email, password)
VALUES
    ('ilkka.ratilainen@gmail.com', 'salasana123');

INSERT INTO project (title, category, userId)
VALUES
    ('Learn SQL', 'School', 1),
    ('Learn JavaScript', 'School', 1),
    ('Project X', 'Personal', 1);

INSERT INTO task (title, taskDate, taskDuration, projectId)
VALUES
    ('Task 1', '2025-11-01', 8, 1),
    ('Task 2', '2025-11-01', 8, 1),
    ('Task 3', '2025-11-09', 8, 2),
    ('Task 4', '2025-11-09', 4, 2),
    ('Task 5', '2025-11-13', 2, 3);

INSERT INTO image (filePath, fileName, taskId)
VALUES
    ('images/', 'TestImage', 1);

INSERT INTO comment (title, comment, taskId, userId)
VALUES
    ('Test1', 'Text for testing purposes', 1, 1);