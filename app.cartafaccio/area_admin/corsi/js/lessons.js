document.addEventListener('DOMContentLoaded', () => {
    // Ottieni l'ID del corso dall'URL
    const urlParams = new URLSearchParams(window.location.search);
    const courseId = urlParams.get('id');

    if (!courseId) {
        document.getElementById('courseTitle').innerText = "Corso non trovato!";
        return;
    }

    // Recupera i dettagli del corso dal server e aggiorna il titolo
    fetch(`php/get_course.php?id=${courseId}`)
        .then(response => response.json())
        .then(course => {
            if (!course || !course.title || !course.description) {
                document.getElementById('courseTitle').innerText = "Corso non trovato!";
                return;
            }

            // Mostra il nome del corso nella pagina
            document.getElementById('courseTitle').innerText = `Gestione: ${course.title}`;
            document.getElementById('courseDescription').innerText = course.description;
        })
        .catch(error => {
            console.error('Errore nel caricamento del corso:', error);
            document.getElementById('courseTitle').innerText = "Errore nel caricamento del corso!";
        });

    // Elementi per la gestione delle lezioni
    const openLessonPopupBtn = document.getElementById('openLessonPopupBtn');
    const lessonPopup = document.getElementById('lessonPopup');
    const overlay = document.getElementById('overlay');
    const cancelLessonBtn = document.getElementById('cancelLessonBtn');
    const saveLessonBtn = document.getElementById('saveLessonBtn');

    // Apri popup per aggiungere una nuova lezione
    openLessonPopupBtn.addEventListener('click', () => {
        overlay.style.display = 'block';
        lessonPopup.style.display = 'block';
    });

    // Chiudi popup senza salvare
    cancelLessonBtn.addEventListener('click', () => {
        overlay.style.display = 'none';
        lessonPopup.style.display = 'none';
    });

    // Salva una nuova lezione
    saveLessonBtn.addEventListener('click', () => {
        overlay.style.display = 'none';
        lessonPopup.style.display = 'none';
    });

    // Carica la lista delle lezioni del corso
    fetch(`php/get_lessons.php?courseId=${courseId}`)
        .then(response => response.json())
        .then(data => {
            const lessonList = document.getElementById('lessonList');
            lessonList.innerHTML = ""; // Pulisce la tabella prima di riempirla

            data.forEach(lesson => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${lesson.title}</td>
                    <td>${lesson.chapter}</td>
                    <td>${lesson.section}</td>
                    <td>${lesson.video}</td>
                    <td>
                        <button onclick="editLesson(${lesson.id})">Modifica</button>
                        <button onclick="deleteLesson(${lesson.id})">Elimina</button>
                    </td>
                `;
                lessonList.appendChild(row);
            });
        })
        .catch(error => console.error('Errore nel caricamento delle lezioni:', error));
});

// Funzione per modificare una lezione
function editLesson(lessonId) {
    // Logica per modificare la lezione
}

// Funzione per eliminare una lezione
function deleteLesson(lessonId) {
    fetch(`php/delete_lesson.php?id=${lessonId}`, { method: 'DELETE' })
        .then(() => location.reload());
}
