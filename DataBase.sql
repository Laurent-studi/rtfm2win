CREATE TABLE user (
    id_user INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(100) NOT NULL,
    role ENUM('PLAYER', 'CREATOR', 'ADMIN') NOT NULL,
    avatar_url VARCHAR(255),
    token VARCHAR(255),
    token_expires_at DATETIME,
    created_at DATETIME,
    updated_at DATETIME
);

CREATE TABLE quiz (
    id_quiz INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    title VARCHAR(150) NOT NULL,
    unique_link VARCHAR(255) NOT NULL,
    qr_code VARCHAR(255),
    created_at DATETIME,
    base_points INT NOT NULL,
    split_points BOOLEAN NOT NULL,
    time_deduction DECIMAL(5,2),
    FOREIGN KEY (user_id) REFERENCES user(id_user)
);

CREATE TABLE session (
    id_session INT PRIMARY KEY AUTO_INCREMENT,
    quiz_id INT NOT NULL,
    start_date DATETIME,
    end_date DATETIME,
    session_active BOOLEAN NOT NULL,
    FOREIGN KEY (quiz_id) REFERENCES quiz(id_quiz)
);

CREATE TABLE participation (
    id_participation INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    session_id INT NOT NULL,
    participation_date DATETIME,
    end_date_participation DATETIME,
    total_score DECIMAL(10,2) NOT NULL,
    rank_position SMALLINT,
    participation_active BOOLEAN NOT NULL,
    FOREIGN KEY (user_id) REFERENCES user(id_user),
    FOREIGN KEY (session_id) REFERENCES session(id_session)
);

CREATE TABLE question (
    id_question INT PRIMARY KEY AUTO_INCREMENT,
    prompt TEXT NOT NULL,
    nb_correct SMALLINT NOT NULL
);

CREATE TABLE quiz_question (
    id_quiz_question INT PRIMARY KEY AUTO_INCREMENT,
    quiz_id INT NOT NULL,
    question_id INT NOT NULL,
    maxtime SMALLINT,
    seq_order SMALLINT,
    FOREIGN KEY (quiz_id) REFERENCES quiz(id_quiz),
    FOREIGN KEY (question_id) REFERENCES question(id_question)
);

CREATE TABLE answer (
    id_answer INT PRIMARY KEY AUTO_INCREMENT,
    question_id INT NOT NULL,
    text VARCHAR(255) NOT NULL,
    is_correct BOOLEAN NOT NULL,
    FOREIGN KEY (question_id) REFERENCES question(id_question)
);

CREATE TABLE participant_answer (
    id_participant_answer INT PRIMARY KEY AUTO_INCREMENT,
    participation_id INT NOT NULL,
    answer_id INT NOT NULL,
    response_time SMALLINT,
    points_earned SMALLINT,
    FOREIGN KEY (participation_id) REFERENCES participation(id_participation),
    FOREIGN KEY (answer_id) REFERENCES answer(id_answer)
);
