function openCalendar(title, location, date, startTime, endTime) {
    const startDate = `${date.replace(/-/g, '')}T${startTime.replace(/:/g, '')}00`;
    const endDate = `${date.replace(/-/g, '')}T${endTime.replace(/:/g, '')}00`;

    const userAgent = navigator.userAgent || navigator.vendor || window.opera;

    if (/iPad|iPhone|iPod/.test(userAgent) && !window.MSStream) {
        // iOS
        window.location.href = `calshow://?start=${startDate}&end=${endDate}`;
    } else if (/android/i.test(userAgent)) {
        // Android
        window.location.href = `content://com.android.calendar/time/${Date.parse(startDate)}`;
    } else {
        // Web-based fallback for desktop
        const url = `https://www.google.com/calendar/render?action=TEMPLATE&text=${encodeURIComponent(title)}&dates=${startDate}/${endDate}&location=${encodeURIComponent(location)}`;
        window.open(url, '_blank');
    }
}

function openMap(location) {
    const encodedLocation = encodeURIComponent(location);

    const userAgent = navigator.userAgent || navigator.vendor || window.opera;

    if (/iPad|iPhone|iPod/.test(userAgent) && !window.MSStream) {
        // Apple Maps
        window.location.href = `http://maps.apple.com/?q=${encodedLocation}`;
    } else if (/android/i.test(userAgent)) {
        // Google Maps
        window.location.href = `geo:0,0?q=${encodedLocation}`;
    } else {
        // Web-based fallback for desktop (Google Maps)
        const url = `https://www.google.com/maps/search/?api=1&query=${encodedLocation}`;
        window.open(url, '_blank');
    }
}
