const translations = {
    en: {
        'home': 'Home',
        'about': 'About',
        'facilities': 'Facilities',
        'contact': 'Contact',
        'book-rooms': 'Book Rooms',
        'floor-plans': 'Floor Plans',
        'login': 'Login',
        'logout': 'Logout',
        'slac-title': 'Student Learning & Activity Center',
        'explore-text': 'Explore Wenzhou-Kean University\'s SLAC facility through our interactive floor plans',
        'explore-button': 'Explore Floor Plans',
        'about-title': 'About SLAC',
        'about-p1': 'The Student Learning & Activity Center (SLAC) at Wenzhou-Kean University is a state-of-the-art facility designed to enhance student learning and extracurricular activities. The center provides various spaces for studying, collaboration, recreation, and events.',
        'about-p2': 'Our interactive website allows you to explore the different areas of SLAC virtually, helping you locate specific facilities and learn about their features.',
        'floor-plans-title': 'Interactive Floor Plans',
        'basement': 'Basement Floor',
        'first': 'First Floor',
        'second': 'Second Floor',
        'third': 'Third Floor',
        'fourth': 'Fourth Floor',
        'fifth': 'Fifth Floor',
        'sixth': 'Sixth Floor',
        'close': 'Close',
        'key-facilities': 'Key Facilities',
        'study-spaces': 'Study Spaces',
        'study-spaces-desc': 'Quiet areas designed for individual and group study sessions.',
        'computer-labs': 'Computer Labs',
        'computer-labs-desc': 'Fully equipped computer facilities for academic and research purposes.',
        'event-halls': 'Event Halls',
        'event-halls-desc': 'Spacious venues for university events, conferences, and activities.',
        'contact-title': 'Contact Us',
        'send-message': 'Send us a Message',
        'contact-info': 'Contact Information',
        'name-label': 'Name',
        'email-label': 'Email',
        'subject-label': 'Subject',
        'message-label': 'Message',
        'send-button': 'Send Message',
        'address-label': 'Address',
        'phone-label': 'Phone',
        'email-info-label': 'Email',
        'social-label': 'Social Media',
        'operating-hours': 'Operating Hours',
        'weekday-hours': 'Monday - Friday: 8:00 AM - 10:00 PM',
        'weekend-hours': 'Saturday - Sunday: 9:00 AM - 9:00 PM',
        'follow-us': 'Follow Us',
        'slac-address': 'Student Learning & Activity Center\nWenzhou-Kean University\n88 Daxue Road, Ouhai\nWenzhou, Zhejiang, China',
        'quick-links': 'Quick Links',
        'connect': 'Connect',
        'address': 'Wenzhou-Kean University<br>88 Daxue Road, Ouhai<br>Wenzhou, Zhejiang, China',
        'copyright': '© 2025 Wenzhou-Kean University. All rights reserved.'
    },
    zh: {
        'home': '首页',
        'about': '关于',
        'facilities': '设施',
        'contact': '联系我们',
        'book-rooms': '预约房间',
        'floor-plans': '楼层平面图',
        'login': '登录',
        'logout': '退出',
        'slac-title': '学生学习与活动中心',
        'explore-text': '通过我们的交互式平面图探索温州肯恩大学SLAC设施',
        'explore-button': '探索平面图',
        'about-title': '关于SLAC',
        'about-p1': '温州肯恩大学学生学习与活动中心（SLAC）是一个先进的设施，旨在促进学生学习和课外活动。中心提供各种空间用于学习、协作、娱乐和活动。',
        'about-p2': '我们的交互式网站允许您虚拟探索SLAC的不同区域，帮助您找到特定设施并了解其功能。',
        'floor-plans-title': '交互式平面图',
        'basement': '地下室',
        'first': '一楼',
        'second': '二楼',
        'third': '三楼',
        'fourth': '四楼',
        'fifth': '五楼',
        'sixth': '六楼',
        'close': '关闭',
        'key-facilities': '主要设施',
        'study-spaces': '学习空间',
        'study-spaces-desc': '为个人和小组学习设计的安静区域。',
        'computer-labs': '电脑实验室',
        'computer-labs-desc': '配备完善的计算机设施，用于学术和研究目的。',
        'event-halls': '活动厅',
        'event-halls-desc': '宽敞的场地，用于大学活动、会议和各类活动。',
        'contact-title': '联系我们',
        'send-message': '发送消息',
        'contact-info': '联系信息',
        'name-label': '姓名',
        'email-label': '电子邮箱',
        'subject-label': '主题',
        'message-label': '消息内容',
        'send-button': '发送消息',
        'address-label': '地址',
        'phone-label': '电话',
        'email-info-label': '电子邮箱',
        'social-label': '社交媒体',
        'operating-hours': '营业时间',
        'weekday-hours': '周一至周五: 上午8:00 - 晚上10:00',
        'weekend-hours': '周六至周日: 上午9:00 - 晚上9:00',
        'follow-us': '关注我们',
        'slac-address': '温州肯恩大学\n学生学习与活动中心\n浙江省温州市瓯海区大学路88号',
        'quick-links': '快速链接',
        'connect': '关注我们',
        'address': '温州肯恩大学<br>浙江省温州市瓯海区大学路88号',
        'copyright': '© 2025 温州肯恩大学。保留所有权利。'
    }
};

function toggleLanguage() {
    const html = document.documentElement;
    const currentLang = html.getAttribute('data-lang');
    const newLang = currentLang === 'en' ? 'zh' : 'en';
    const langToggle = document.getElementById('langToggle');
    
    // Update language attributes
    html.setAttribute('data-lang', newLang);
    html.setAttribute('lang', newLang);
    
    // Update toggle button text
    langToggle.textContent = newLang === 'en' ? '中文' : 'English';
    
    // Update all translatable elements
    document.querySelectorAll('[data-translate]').forEach(element => {
        const key = element.getAttribute('data-translate');
        if (translations[newLang][key]) {
            if (element.tagName.toLowerCase() === 'input' || element.tagName.toLowerCase() === 'textarea') {
                element.placeholder = translations[newLang][key];
            } else {
                element.innerHTML = translations[newLang][key];
            }
        }
    });
}

// Add translation attributes when document is ready
// Initialize translations when page loads
function initializeTranslations() {
    const html = document.documentElement;
    const currentLang = html.getAttribute('data-lang') || 'en';
    const langToggle = document.getElementById('langToggle');
    
    // Set initial language state
    html.setAttribute('data-lang', currentLang);
    html.setAttribute('lang', currentLang);
    
    // Set initial toggle button text
    if (langToggle) {
        langToggle.textContent = currentLang === 'en' ? '中文' : 'English';
    }
    
    // Update all translatable elements
    document.querySelectorAll('[data-translate]').forEach(element => {
        const key = element.getAttribute('data-translate');
        if (translations[currentLang][key]) {
            if (element.tagName.toLowerCase() === 'input' || element.tagName.toLowerCase() === 'textarea') {
                element.placeholder = translations[currentLang][key];
            } else {
                element.innerHTML = translations[currentLang][key];
            }
        }
    });
}

document.addEventListener('DOMContentLoaded', function() {
    const elements = {
        '.navbar-nav .nav-link[href="#"]': 'home',
        '.navbar-nav .nav-link[href="#about"]': 'about',
        '.navbar-nav .nav-link[href="#facilities"]': 'facilities',
        '.navbar-nav .nav-link[href="contact.html"]': 'contact',
        '.navbar-nav .nav-link[href="php/appointment/rooms.php"]': 'book-rooms',
        '.display-4': 'slac-title',
        '.lead': 'explore-text',
        '.btn-primary.btn-lg': 'explore-button',
        '#about h2': 'about-title',
        '#about p:first-of-type': 'about-p1',
        '#about p:last-of-type': 'about-p2',
        '#floor-plans h2': 'floor-plans-title',
        '[data-floor="0"]': 'basement',
        '[data-floor="1"]': 'first',
        '[data-floor="2"]': 'second',
        '[data-floor="3"]': 'third',
        '[data-floor="4"]': 'fourth',
        '[data-floor="5"]': 'fifth',
        '[data-floor="6"]': 'sixth',
        '.modal .btn-secondary': 'close',
        'footer h5:nth-of-type(2)': 'quick-links',
        'footer h5:nth-of-type(3)': 'connect',
        'footer p:first-of-type': 'address',
        'footer .text-center p': 'copyright'
    };

    // Add data-translate attributes to elements
    for (const [selector, key] of Object.entries(elements)) {
        document.querySelectorAll(selector).forEach(element => {
            element.setAttribute('data-translate', key);
        });
    }
    
    // Initialize translations after setting data-translate attributes
    initializeTranslations();
});
