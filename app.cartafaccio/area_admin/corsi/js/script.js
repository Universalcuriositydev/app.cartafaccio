document.addEventListener('DOMContentLoaded', () => {
    const openCoursePopupBtn = document.getElementById('openCoursePopupBtn');
    const coursePopup = document.getElementById('coursePopup');
    const overlay = document.getElementById('overlay');
    const cancelCourseBtn = document.getElementById('cancelCourseBtn');
    const saveCourseBtn = document.getElementById('saveCourseBtn');
    const courseName = document.getElementById('courseName');
    const courseDescription = document.getElementById('courseDescription');
    const courseList = document.getElementById('courseList');

    // Popup di eliminazione
    const deletePopup = document.getElementById('deleteConfirmPopup');
    const deleteOverlay = document.getElementById('deleteOverlay');
    const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');
    const cancelDeleteBtn = document.getElementById('cancelDeleteBtn');
    let courseIdToDelete = null;

    // Mostra popup per inserire nuovo corso
    openCoursePopupBtn.addEventListener('click', () => {
        overlay.style.display = 'block';
        coursePopup.style.display = 'block';

        // Reset dei campi
        courseName.value = '';
        courseDescription.value = '';

        saveCourseBtn.onclick = saveCourses; // Assicura che il pulsante salvi un nuovo corso
    });

    // Chiudi popup di inserimento
    cancelCourseBtn.addEventListener('click', () => {
        overlay.style.display = 'none';
        coursePopup.style.display = 'none';
    });

    // Mostra popup di conferma eliminazione
    window.deleteCourse = function(courseId) {
        courseIdToDelete = courseId;
        deleteOverlay.style.display = 'block';
        deletePopup.style.display = 'block';
    };

    // Conferma eliminazione
    confirmDeleteBtn.addEventListener('click', () => {
        if (courseIdToDelete !== null) {
            fetch('php/delete_course.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: `id=${encodeURIComponent(courseIdToDelete)}`
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        loadCourses(); // 🔥 Nessun alert, aggiorna direttamente la lista
                    }
                })
                .finally(() => {
                    closeDeletePopup();
                });
        }
    });

    // Annulla eliminazione
    cancelDeleteBtn.addEventListener('click', closeDeletePopup);

    function closeDeletePopup() {
        deleteOverlay.style.display = 'none';
        deletePopup.style.display = 'none';
        courseIdToDelete = null;
    }

    // Carica la lista dei corsi
    function loadCourses() {
        console.log("Tentativo di caricamento dei corsi...");

        fetch('php/get_courses.php')
            .then(response => response.json())
            .then(data => {
                console.log("Dati ricevuti:", data);

                courseList.innerHTML = '';

                // Se non ci sono corsi, esce senza errori
                if (data.message === "Nessun corso trovato") {
                    console.warn("⚠️ Nessun corso trovato.");
                    return;
                }

                if (!Array.isArray(data)) {
                    throw new Error('Dati non validi ricevuti dal server');
                }

                data.forEach(course => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td>${course.title}</td>
                        <td>${course.description}</td>
                        <td>
                            <button onclick="editCourse(${course.id})">Modifica</button>
                            <button onclick="deleteCourse(${course.id})">Elimina</button>
                        </td>
                    `;
                    courseList.appendChild(row);
                });
            })
            .catch(error => {
                console.error('Errore nel caricamento dei corsi:', error);
            });
    }

    // Modifica corso
    function editCourse(courseId) {
        fetch(`php/get_course.php?id=${courseId}`)
            .then(response => response.json())
            .then(course => {
                if (!course || !course.title || !course.description) {
                    throw new Error("Dati del corso non validi ricevuti dal server.");
                }

                courseName.value = course.title;
                courseDescription.value = course.description;

                overlay.style.display = 'block';
                coursePopup.style.display = 'block';

                // Salvataggio modifica
                saveCourseBtn.onclick = function () {
                    const updatedTitle = courseName.value;
                    const updatedDescription = courseDescription.value;

                    if (!updatedTitle || !updatedDescription) {
                        return;
                    }

                    fetch('php/update_course.php', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                        body: `id=${encodeURIComponent(courseId)}&title=${encodeURIComponent(updatedTitle)}&description=${encodeURIComponent(updatedDescription)}`
                    })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                overlay.style.display = 'none';
                                coursePopup.style.display = 'none';
                                loadCourses();
                            }
                        })
                        .catch(error => {
                            console.error('Errore nell\'aggiornamento:', error);
                        });
                };
            })
            .catch(error => {
                console.error("Errore nel recupero dei dati del corso:", error);
            });
    }

    // Salvataggio nuovo corso
    function saveCourses() {
        const title = courseName.value;
        const text = courseDescription.value;

        if (!title || !text) {
            return;
        }

        fetch('php/insert_course.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ title, text })
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    overlay.style.display = 'none';
                    coursePopup.style.display = 'none';
                    loadCourses();
                }
            })
            .catch(error => {
                console.error('Errore nella richiesta:', error);
            });
    }

    // Carica i corsi all'avvio
    loadCourses();
});
