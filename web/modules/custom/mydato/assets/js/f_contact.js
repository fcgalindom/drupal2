(function ($) {

  $.validator.addMethod("email_exists", function(value, element) {
      return !$('#edit-email').hasClass('email-exists');
  }, "El email1 ya se encuentra registrado.");

  $.validator.addMethod("spanish_words", function (value, element) {
    //var re = new RegExp("[a-zA-ZñÑáéíóúüÁÉÍÓÚÜ]");
    var re = new RegExp("^[a-zA-ZñÑáéíóúüÁÉÍÓÚÜ ]*$");
    return re.test(value);
  }, "Contiene caracteres inválidos");

  $.validator.addMethod("id_exists", function(value, element) {
  return !$('#edit-id').hasClass('id-exists');
  }, "El identificacion ya se encuentra registrado.");

  $.validator.addMethod("telefono_exists", function(value, element) {
    return !$('#edit-telefono').hasClass('telefono-exists');
  }, "El teléfono1 ya se encuentra registrado.");

  $.validator.addMethod("emailname", function(value, element) {
    var re = new RegExp("[+]+[0-9]+$");
    var email = value.split("@");

    var ed = new RegExp("^[A-Za-z0-9.-]+\.[A-Za-z]{2,}$");
    if (email.length < 2) {
      return true;
    }
    
    return !re.test(email[0]) && ed.test(email[1]);
  }, "Por favor, escribe una dirección de correo válida.");

  $.validator.addMethod("emailDomainRestriction", function(value, element) {
    var domain_restricted = [ 
      'temp-mail.org','correotemporal.org','mohmal.com','yopmail.com',
      'tempail.com','emailondeck.com','emailtemporalgratis.com','crazymailing.com',
      'tempr.email','bupmail.com','guerrillamail.com','temp-mail.io',
      'es.emailfake.com','nowmymail.com','10minutemail.net','es.getairmail.com',
      'mailf5.com','flashmail.it','10minemail.com','mailcatch.com','temp-mails.com',
      'spambox.us','mailnull.com','incognitomail.com','ssl.trashmail.net','trashmail.net',
      'mailinator.com','tempinbox.com','filzmail.com','dropmail.me','spam4.me','cs.email',
      'one-off.email','throwawaymail.com','emailtemporal.org','maildrop.cc',
      'mailforspam.com','trashmail.com','teleworm.us','superrito.com','rhyta.com',
      'jourrapide.com','gustr.com','fleckens.hu','einrot.com','cuvox.de','dayrep.com',
      'muyoc.com','buxod.com','pidox.org','mecip.net','pudxe.com','xedmi.com','ludxc.com',
      'juzab.com','klepf.com','matra.site','bombamail.icu','yermail.net',
      'totallynotfake.net','techblast.ch','spamthis.network','spammy.host','spammer.fail',
      'shadap.org','pewpewpewpew.pw','netcom.ws','itcompu.com','disposable.site',
      'deinbox.com','sharklasers.com','guerrillamailblock.com','guerrillamail.org',
      'guerrillamail.net','guerrillamail.de','guerrillamail.biz','grr.la','netmail.tk',
      'laste.ml','firste.ml','zeroe.ml','supere.ml','emlhub.com','emlpro.com','emltmp.com',
      'yomail.info','10mail.org','wegwerfmail.org','wegwerfmail.net','wegwerfmail.de',
      'trashmail.me','trashmail.io','trashmail.at','trash-mail.at','rcpt.at','proxymail.eu',
      'objectmail.com','kurzepost.de','damnthespam.com','contbay.com','0box.eu',
      'marmaryta.space','5y5u.com','58as.com','firemailbox.club','mozej.com','mailna.co',
      'mailna.in','mailna.me','mohmal.im','mohmal.in','yopmail.fr','yopmail.net',
      'cool.fr.nf','jetable.fr.nf','nospam.ze.tc','nomail.xl.cx','mega.zik.dj','speed.1s.fr',
      'courriel.fr.nf','moncourrier.fr.nf','monemail.fr.nf','monmail.fr.nf','nedoz.com',
      'nmagazinec.com','armyspy.com','vmani.com','discard.email','discardmail.com',
      'discardmail.de','spambog.com','spambog.de','spambog.ru','0btcmail.pw','815.ru',
      'knol-power.nl','hartbot.de','freundin.ru','smashmail.de','s0ny.net','pecinan.net',
      'budaya-tionghoa.com','lajoska.pe.hu','1mail.x24hr.com','from.onmypc.info',
      'now.mefound.com','mowgli.jungleheart.com','yourspamgoesto.space','pecinan.org',
      'budayationghoa.com','CR.cloudns.asia','TLS.cloudns.asia','MSFT.cloudns.asia',
      'B.cr.cloUdnS.asia','ssl.tls.cloudns.ASIA','sweetxxx.de','DVD.dns-cloud.net',
      'DVD.dnsabr.com','BD.dns-cloud.net','YX.dns-cloud.net','SHIT.dns-cloud.net',
      'SHIT.dnsabr.com','eu.dns-cloud.net','eu.dnsabr.com','asia.dnsabr.com',
      '8.dnsabr.com','pw.8.dnsabr.com','mm.8.dnsabr.com','23.8.dnsabr.com','pecinan.com',
      'disposable-email.ml','pw.epac.to','postheo.de','sexy.camdvr.org','Disposable.ml',
      '888.dnS-clouD.NET','adult-work.info','casinokun.hu','bangsat.in','wallus.casinokun.hu',
      'trap-mail.de','umailz.com','panchoalts.com','gmaile.design','ersatzauto.ch',
      'tempes.gq','cpmail.life','tempemail.info','coolmailcool.com','kittenemail.com',
      '99email.xyz','notmyemail.tech','m.cloudns.cl','twitter-sign-in.cf','anonymized.org',
      'you.has.dating','ketoblazepro.com','kost.party','0hio0ak.com','4dentalsolutions.com',
      't.woeishyang.com','ondemandemail.top','kittenemail.xyz','blackturtle.xyz',
      'y.x.ssl.cloudns.asia','geneseeit.com','mailg.ml','media.motornation.buzz',
      'sage.speedfocus.biz','badlion.co.uk','safeemail.xyz','virtual-generations.com',
      'new-york.host','mrdeeps.ml','kitela.work','fouadps.cf','megacorp.work','fake-wegwerf.email',
      'tigytech.com','historictheology.com','ma.567map.xyz','hotmailproduct.com','maxsize.online',
      'happyfreshdrink.com','denomla.com','pansamantala.poistaa.com','sahaltastari.sytes.net',
      'cecep.ddnsking.com','fadilmalik.ddnsking.com','csingi.sytes.net','richmail.ga','tikmail.gq',
      'bupkiss.ml','guerrillamail.info','pokemail.net','myinbox.icu','just4fun.me','inscriptio.in',
      'cloud-mail.top','safemail.icu','montokop.pw','tempamailbox.info','blogtron.com',
      'atanetorg.org','aristockphoto.com','jomcs.com','kukuka.org','gothill.com','mixely.com',
      'marsoasis.org','walmarteshop.com','outlandlabs.com','comectrix.com','buymondo.com',
      'eventao.com','louieliu.com','mymailnow.xyz','cuoly.com','getnada.com','abyssmail.com',
      'boximail.com','clrmail.com','dropjar.com','getairmail.com','givmail.com','inboxbear.com',
      'robot-mail.com','tafmail.com','vomoto.com','zetmail.com'];
    var email = value.split("@");
    var domain = email[1];
    //console.log("domain:"+domain);
    var valid=true;
    $.each(domain_restricted, function (key, value){
      if (value == domain) {
        valid = false;
      }
    });
    return valid;
  }, "Por favor, escribe una dirección de correo válida.");

  
  jQuery.validator.addMethod("validdate", function (value, element) {
    var day = jQuery("#edit-day").val();
    var month = jQuery("#edit-month").val();
    var year = jQuery("#edit-year").val();

    return isValidDate(day,month,year);
  },
    "Ingresa una fecha válida"
  );
  

  jQuery.validator.addMethod("agecheck", function (value, element) {
    var day = jQuery("#edit-day").val();
    var month = jQuery("#edit-month").val();
    var year = jQuery("#edit-year").val();
    var age = 18;

    var mydate = new Date();
    mydate.setFullYear(year, month - 1, day);

    var currdate = new Date();
    currdate.setFullYear(currdate.getFullYear() - age);

    return currdate >= mydate;
  },
    "Debes ser mayor de edad para registrarte"
  );

  jQuery.validator.addMethod("rangelength", function (value, element, param) {
    //console.log("range:" + value);
    param[2]=value.length;
    return ((value.length >= param[0]) && (value.length <= param[1]));
  },
    "You are only allowed between {0} and {1}. You have typed {2} characters"
  ); 

  
  /**
  * Add Drupal behaviors
  */
  Drupal.behaviors.ABCPRegister = {
    attach: function () {
      $('#btn-submit').click(function() {
        var form = $('form');
        form.validate();
        if (form.valid()) {
          $('#edit-submit').mousedown();
        }
      });
    }
  };

  function isValidDate(day,month,year) {
  
    var date = new Date();
    date.setFullYear(year, month - 1, day);
    // month - 1 since the month index is 0-based (0 = January)
  
    if ( (date.getFullYear() == year) && (date.getMonth() == month - 1) && (date.getDate() == day) ) {
      return true;
    }
    return false;
  }

})(jQuery);