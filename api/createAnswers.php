<?php
use Rtfm2win\Answer;
try {
            $text = $answerData['text'] ?? '';
            $isCorrect = returnIntCheckBox($answerData['isCorrect'] ?? '0');

            if (empty($text)) {
                throw new \Exception('Le texte de la réponse est vide.');
            }

            $answer = new Answer();
            $answer->setText($text);
            $answer->setIsCorrect($isCorrect);
            $answer->setIdQuestion($id);

            $newAnswer = $answer->saveAnswer();
            $savedAnswers[] = [
                'text' => $answer->getText(),
                'isCorrect' => $answer->getIsCorrect(),
            ];
        } catch (\PDOException $e) {
            http_response_code(500);
            echo json_encode(['error' => 'Erreur de base de données : ' . $e->getMessage()]);
            exit;
        } catch (\Exception $e) {
            http_response_code(400);
            echo json_encode(['error' => 'Erreur lors de la création de la réponse : ' . $e->getMessage()]);
            exit;
        }